<?php

namespace Providers; #auto

use Mmb\Provider\Provider;

class GuardProvider extends Provider
{

    public function register()
    {
        $this->loadConfigFrom(__DIR__ . '/../Configs/policies.php', 'policies');

        foreach (config('policies') as $policy)
        {
            $this->registerPolicy($policy);
        }

        $this->notAllowed(function () {

            replyText(lang('access_danied') ?: "شما به این بخش دسترسی ندارید");

        });
    }
    
}
