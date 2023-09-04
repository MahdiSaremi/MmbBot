<?php
#auto-name
namespace App\Addon\Panel\ChannelLock;

use App\Panel\Panel;
use Mmb\Controller\Controller;

class ChannelLockPanel extends Controller
{

    public function main()
    {
        responseMenu($this->menu, "انتخاب کنید:");
    }
    
    public function menu()
    {
        return $this->createFixMenu('menu', [
            
            [ static::key("➕ افزودن کانال", 'add') ],
            [ static::key("✖️ حذف کانال", 'del') ],

            [ static::key("بازگشت", 'back') ],

        ]);
    }

    public function add()
    {
        return Form\AddForm::request();
    }

    public function del()
    {
        return Form\DelForm::request();
    }

    public function back()
    {
        return Panel::invokeWith("به پنل مدیریت بازگشتید");
    }

}
