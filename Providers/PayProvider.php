<?php
#auto-name
namespace Providers;

use Mmb\Pay\PayDriver;
use Mmb\Provider\Provider;

class PayProvider extends Provider
{

    public $debug_mode;

    public function register()
    {

        $this->loadConfigFrom(__DIR__ . '/../Configs/pay.php', 'pay');

        $payConfig = config('pay');

        $this->debug_mode = $payConfig['debug'] ?? false;

        foreach($payConfig['all'] as $name => $config)
        {
            $this->registerPay($name, $config);
        }

    }

    public function registerPay($name, $config)
    {
        $driver = $config['driver'];

        $this->onInstance($driver, function () use ($driver, $config) {
            $pay = new $driver($config['key'], $this->debug_mode);
            $pay->callbackUrl = $config['url'] ?? config('pay.url');
            if (isset($config['storage']))
                $pay->storage = $config['storage'];
            if (isset($config['debug']))
                $pay->debug = $config['debug'];
            return $pay;
        });
        $this->onInstance("pay.$name", function () use ($driver) {
            return app($driver);
        });

        if($name == 'main')
            $this->onInstance(PayDriver::class, function () use ($driver) {
                return app($driver);
            });

    }
    
}
