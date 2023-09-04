<?php

namespace Providers; #auto

use Mmb\Controller\Response;
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

        $this->loadLangFrom(__DIR__ . '/../Lang/Form');
        $this->loadLangFrom(__DIR__ . '/../Lang');
        
        $this->load();
    }

    public function load()
    {
        // Register mmb object
        Mmb::$this = new Mmb(config('bot.token'));
        $this->onInstance('mmb', function()
        {
            return Mmb::$this;
        });

        // Set default language
        Lang::setDefault(config('app.lang'));
        Lang::setLang(Lang::getDefault());

        // Set debug mode
        if(config('app.debug'))
            Debug::on();

        // Set response method
        Response::setResponse('reply');
    }
    
}
