<?php
#auto-name
namespace App\Addon\Panel\ForAll;

use App\Panel\Panel;
use Mmb\Controller\Controller;

class ForAllPanel extends Controller
{

    public function main()
    {
        responseMenu($this->menu, "انتخاب کنید:");
    }

    public function menu()
    {
        return $this->createFixMenu('menu', [

            [ static::key("📩 پیام همگانی", 'send2all') ],
            [ static::key("📩 فوروارد همگانی", 'forward2all') ],

            [ static::key("بازگشت", 'back') ],

        ]);
    }

    public function send2all()
    {
        return Send2AllForm::request();
    }

    public function forward2all()
    {
        return Forward2AllForm::request();
    }

    public function back()
    {
        return Panel::invokeWith("به پنل بازگشتید");
    }
    
}
