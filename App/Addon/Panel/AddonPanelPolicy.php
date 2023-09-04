<?php
#auto-name
namespace App\Addon\Panel;

use Mmb\Compile\Attributes\AsPolicy;
use Mmb\Guard\Policy;

#[AsPolicy]
class AddonPanelPolicy extends Policy
{

    public function boot()
    {
        $this->classPrefixNeedTo('App\Addon\Panel\\', 'access_panel');
        // $this->classPrefixNeedTo('App\Addon\Panel\ForAll\\', 'access_forall');
        // $this->classPrefixNeedTo('App\Addon\Panel\User\\', 'access_users');
    }
    
}
