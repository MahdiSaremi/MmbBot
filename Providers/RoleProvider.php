<?php

namespace Providers; #auto

use Mmb\Guard\Role;
use Mmb\Provider\Provider;

class RoleProvider extends Provider
{

    public function register()
    {
        $this->loadConfigFrom(__DIR__ . '/../Configs/roles.php', 'roles');

        $roles = config()->get('roles.roles');
        $const = config()->get('roles.const');
        
        Role::setRoles($roles);
        Role::setDefault('default');

        Role::constant($const);
    }
    
}
