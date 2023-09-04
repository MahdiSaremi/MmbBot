<?php
#auto-name
namespace App\Addon\Panel\User;

use App\Panel\Panel;
use Mmb\Controller\Controller;
use Models\User;

class UsersPanel extends Controller
{

    public function main()
    {
        responseMenu($this->menu, "انتخاب کنید:");
    }

    public function menu()
    {
        return $this->createFixMenu('menu', [

            [ static::key("📊 آمار", 'status') ],

            [
                static::key("👤 لیست کاربران", 'users'),
                static::key("🚫 کاربران بن شده", 'bans'),
            ],

            [
                static::key("🔍 جستجوی کاربر", 'find')
            ],

            [
                static::keyIf(UserList\UserAdminListShow::allowed(), "👨‍💻 لیست ادمین ها", 'admins'),
            ],

            [
                static::key("بازگشت", 'back'),
            ],

        ]);
    }

    public function status()
    {
        response("
⚪️ آمار ربات


👤 تعداد کاربران : ".User::count()."

🚫 کاربران بن شده : ".User::whereBan(true)->count()."
        ");
    }

    public function users()
    {
        return UserList\UserListShow::invoke('page', 1);
    }

    public function bans()
    {
        return UserList\UserBanListShow::invoke('page', 1);
    }

    public function admins()
    {
        return UserList\UserAdminListShow::invoke('page', 1);
    }

    public function find()
    {
        return Profile\FindUserForm::request();
    }

    public function back()
    {
        return Panel::invokeWith("به پنل مدیریت بازگشتید");
    }

}
