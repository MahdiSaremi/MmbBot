<?php
#auto-name
namespace App\Addon\Panel\User\UserList;

use Models\User;

class UserAdminListShow extends UserListController
{

    public function boot()
    {
        $this->needTo('manage_admins');
    }
    
	public function name()
    {
        return '.admins';
	}
	
	public function query()
    {
        return User::whereRole('admin');
	}

    public function textKey($model)
    {
        return "👨‍💻 {$model->id}";
    }

    public function text($page, $pages, $count)
    {
        return "
👨‍💻 لیست ادمین ها


🔖 صفحه $page/$pages
        ";
    }
    
}
