<?php
#auto-name
namespace App\Panel;

use Mmb\Compile\Attributes\AsPolicy;
use Mmb\Guard\Policy;
use Models\User;

#[AsPolicy]
class AdminPolicy extends Policy
{

    public function boot()
    {
        $this->classPrefixNeedTo('App\Panel\\', 'access_panel');
    }

    public function access_panel(?User $user)
    {
        return $user && $user->role->access_panel;
    }

    public function manage_admins(?User $user)
    {
        return $user && $user->role->manage_admins;
    }
    
}
