<?php

namespace App\Panel; #auto

use Mmb\Guard\Policy;

class AdminPolicy extends Policy
{

    public function access_panel(\Models\User $user)
    {
        return $user->role->access_panel;
    }
    
}
