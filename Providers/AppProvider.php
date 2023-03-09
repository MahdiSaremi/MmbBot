<?php

namespace Providers; #auto

use Mmb\Debug\Debug;
use Mmb\Lang\Lang;
use Mmb\Mmb;
use Mmb\Provider\Provider;

class AppProvider extends Provider
{

    public function register()
    {

        $this->loadConfigFrom(__DIR__ . '/../Configs/app.php', 'app');
        $this->loadConfigFrom(__DIR__ . '/../Configs/bot.php', 'bot');

        $this->loadLangFrom(__DIR__ . '/../Lang');
        $this->loadLangFrom(__DIR__ . '/../Lang/Form');
        
        $this->setStoragePath(__DIR__ . '/../Storage');

        $this->load();

    }

    public function load()
    {
        
        Mmb::$this = new Mmb(config('bot.token'));
        $this->onInstance('mmb', function() {
            return Mmb::$this;
        });

        Lang::setLang(config('app.lang'));

        if(config('app.debug')) Debug::on();

    }
    
}
