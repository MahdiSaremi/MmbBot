<?php
#auto-name
namespace Mmb\Storage;

use Closure;
use Mmb\Exceptions\MmbException;
use Mmb\Mapping\Arrayable;

class FrameStore implements Arrayable
{

    /**
     * نام کلاس استوریج را بر می گرداند
     *
     * @return string
     */
    public static function getStorage()
    {
        return Globals::class;
        // throw new MmbException("Class " . static::class . " must implements getStorage() method");
    }

    /**
     * آدرس سلکتوری که در آن ذخیره می شود را بر می گرداند
     * 
     * به عنوان مثال اگر `settings.bot` وارد شود، وارد آن آدرس می شود و از اطلاعات آنجا استفاده می کند
     *
     * @return ?string
     */
    public static function getAddress()
    {
        return null;
    }

    private static $datas = [];

    /**
     * دیتا را بر می گرداند یا آن را لود می کند
     * 
     * این تابع تنها یک بار دیتا را لود می کند
     *
     * @return static
     */
    public static function data()
    {
        if(!isset(static::$datas[static::class]))
        {
            return static::$datas[static::class] = static::load();
        }
        
        return static::$datas[static::class];
    }

    /**
     * دیتا را لود می کند و بر می گرداند
     *
     * @return static
     */
    public static function load()
    {
        return new static;
    }

    public function __construct()
    {
        $storage = static::getStorage();
        $address = static::getAddress();
        $data = is_null($address) ? $storage::getBase() : $storage::get($address, []);
        foreach(get_object_vars($this) as $name => $value)
        {
            if($name[0] == '_') continue;
            if(array_key_exists($name, $data))
            {
                $this->set($name, $data[$name], true);
            }
            elseif($value instanceof Closure)
            {
                $this->$name = $value();
            }
        }
    }

    public function toArray()
    {
        $result = [];
        
        foreach(get_object_vars($this) as $name => $value)
        {
            if($name[0] == '_') continue;
            $result[$name] = $this->get($name, true);
        }

        return $result;
    }

    /**
     * دیتا را ذخیره می کند
     *
     * @return $this
     */
    public function save()
    {
        $storage = static::getStorage();
        $address = static::getAddress();
        if(is_null($address))
        {
            $storage::editBase(function(&$data)
            {
                $data = array_replace($data, $this->toArray());
            });
        }
        else
        {
            if(!Storage::exists($address))
            {
                Storage::set($address, []);
            }

            $storage::edit($address, function(&$data)
            {
                $data = array_replace($data, $this->toArray());
            });
        }

        return $this;
    }

    /**
     * تنظیم مقدار
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function set(string $name, $value, bool $fromLoad = false)
    {
        if($fromLoad && method_exists($this, "onLoad$name"))
        {
            $callback = "onLoad$name";
            $this->$callback($value);
            return $this;
        }

        if(method_exists($this, "set$name"))
        {
            $callback = "set$name";
            $this->$callback($value);
            return $this;
        }
        
        $this->$name = $value;
        return $this;
    }

    /**
     * تنظیم چند مقدار همزمان
     *
     * @param array $values
     * @return $this
     */
    public function setAll(array $values)
    {
        foreach($values as $name => $value)
        {
            $this->set($name, $value);
        }

        return $this;
    }
    
    /**
     * گرفتن مقدار
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name, bool $forSave = false)
    {
        if($forSave && method_exists($this, "onSave$name"))
        {
            $callback = "onSave$name";
            return $this->$callback();
        }

        if(method_exists($this, "get$name"))
        {
            $callback = "get$name";
            return $this->$callback($forSave);
        }
        
        return $this->$name;
    }

}
