<?php
#auto-name
namespace App\Addon\Panel\User\UserList;

use Models\User;

class UserBanListShow extends UserListController
{
    
	public function name()
    {
        return '.usersban';
	}
	
	public function query()
    {
        return User::query()->whereBan(true);
	}

    public function textKey($model)
    {
        return "🚫 {$model->id}";
    }

    public function text($page, $pages, $count)
    {
        return "
🚫 لیست کاربران بن شده


🔖 صفحه $page/$pages
        ";
    }
    
}
