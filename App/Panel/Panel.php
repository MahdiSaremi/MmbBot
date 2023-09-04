<?php
#auto-name
namespace App\Panel;

use App\Home\Home;
use Mmb\Compile\Attributes\OnCommand;
use Mmb\Controller\Controller;

class Panel extends Controller
{

    #[OnCommand(['/panel', 'پنل'])]
    public function main()
    {
        responseMenu($this->menu, "وارد پنل مدیریت شدید:");
    }

    public function menu()
    {
        return $this->createFixMenu('menu', [

            [ static::key("بازگشت", 'back') ],

        ]);
    }

    public function back()
    {
        return Home::invokeWith("به منوی اصلی بازگشتید");
    }

}
