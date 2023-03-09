<?php

namespace App\Panel; #auto

use App\Actions\Menu;
use App\Home\Home;
use App\Home\Start\StartController;
use Mmb\Controller\Menu as MenuBuilder;

class Panel extends PanelBase
{

    public function panel()
    {
        replyText("وارد پنل مدیریت شدید:", [
            'menu' => $this->menu,
        ]);

        return $this->menu;
    }

    public function menu()
    {
        return MenuBuilder::new ([

            [ Home::key("بازگشت", 'start') ],

        ]);
    }
    
}
