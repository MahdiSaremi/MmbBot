<?php

namespace App\Home; #auto

use App\Panel\Panel;
use Mmb\Controller\Controller;
use Mmb\Controller\Menu;

class Home extends Controller
{

    public function start()
    {
        replyText("خوش آمدید", [
            'menu' => $this->menu,
        ]);

        return $this->menu;
    }

    public function menu()
    {
        return Menu::new ([

            [ self::key('ام ام بی', 'mmb') ],

            [ Panel::allowed() ? Panel::key("پنل مدیریت", 'panel') : null ],

        ]);
    }

    public function mmb()
    {
        replyText("mmblib.ir :)");
    }
    
}
