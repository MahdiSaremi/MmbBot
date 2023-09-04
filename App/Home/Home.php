<?php
#auto-name
namespace App\Home;

use App\Panel\Panel;
use Mmb\Controller\Controller;

class Home extends Controller
{

    public function main()
    {
        responseMenu($this->menu, "خوش آمدید");
    }

    public function menu()
    {
        return $this->createFixMenu('menu', [

            [ Panel::keyIfAllowed("پنل مدیریت", 'main') ],

        ]);
    }

}
