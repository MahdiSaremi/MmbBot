<?php
#auto-name
namespace App\Addon\Panel\User\UserList;

use Models\User;

class UserListShow extends UserListController
{
    
	public function name()
    {
        return '.users';
	}
	
	public function query()
    {
        return User::query()->orderDescBy('join_at');
	}

    public function textKey($model)
    {
        return "👤 {$model->id}";
    }

    public function text($page, $pages, $count)
    {
        return "
👤 لیست کاربران اخیر


🔖 صفحه $page/$pages
        ";
    }
    
}
