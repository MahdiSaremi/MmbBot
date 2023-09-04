<?php
#auto-name
namespace App;

use Mmb\Compile\Attributes\AutoHandle;
use Mmb\Controller\Handler\Handler;
use Models\User;

#[AutoHandle('pv', offset:0)]
class BanBlock extends Handler
{

    public function handle()
    {
        if(User::$this && User::$this->ban && !User::$this->role->ignore_ban)
        {
            $this->stop();
        }
    }
    
}
