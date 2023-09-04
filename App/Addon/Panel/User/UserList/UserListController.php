<?php
#auto-name
namespace App\Addon\Panel\User\UserList;

use App\Addon\Panel\User\Profile\UserManage;
use Mmb\Compile\Attributes\AutoHandle;
use Mmb\Controller\Controller;
use Mmb\Controller\QueryControl\CallbackControl;
use Mmb\Controller\QueryControl\QueryBooter;
use Mmb\Tools\ATool;

/**
 * + Add `YourController::callbackQuery(),` to `Handles\pv.php` (Compiler will add this)
 */
#[AutoHandle('pv', call: 'callbackQuery')]
abstract class UserListController extends Controller
{

    use CallbackControl;
    public function bootCallback(QueryBooter $booter)
    {
        $booter->pattern($this->name().":{page}")
                ->int('page')
                ->invoke('page');
    }

    public function page($page = 1)
    {
        $numPerPage = $this->numPerPage();
        $pages = ceil($this->query()->count() / $numPerPage);
        if($page > $pages)
        {
            if(callback())
            {
                answer("❌ صفحه خالیست");
            }
            else
            {
                response("❌ لیست خالیست");
            }
            return;
        }

        if(callback())
            answer("لطفا صبر کنید...");

        $all = $this->query()->offset(($page - 1) * $numPerPage)->limit($numPerPage)->all();
        
        $key = [];
        foreach($all as $model)
        {
            $key[] = 
                UserManage::keyInline($this->textKey($model), $model->id);
        }
        $key = ATool::make2D($key, 2);

        $key[] = [
            static::keyInline($this->textNextPage(), $page + 1),
            static::keyInline($this->textPrevPage(), $page == 1 ? 1 : $page - 1),
        ];

        $method = callback() ? 'editText' : 'response';
        $method($this->text($page, $pages, count($all)), [
            'key' => $key,
            'ignore' => true,
        ]);
    }

    public abstract function name();
    public abstract function query();
    public function numPerPage()
    {
        return 16;
    }
    public function textKey($model)
    {
        return "👤 {$model->id}";
    }
    public function textNextPage()
    {
        return "صفحه بعدی ⬅️";
    }
    public function textPrevPage()
    {
        return "➡️ صفحه قبلی";
    }
    public function text($page, $pages, $count)
    {
        return "
👤 لیست کاربران


🔖 صفحه $page/$pages
        ";
    }

}
