<?php

namespace App\Home\Start; #auto

use App\Home\Home;
use Mmb\Controller\StartController as Controller;

class StartController extends Controller
{

    protected $supportedTypes = [ 'invite' ];
    
	public function start()
    {
        return Home::invoke('start');
	}

    public function invite($from, \Models\User $user)
    {
        if($user->newCreated)
        {
            $user2 = \Models\User::find($from);
            if($user2 && $user2->id != $user->id)
            {
                // $user2->newInvite();
                mmb()->sendMsg([
                    'chat' => $user2->id,
                    'text' => "یک کاربر جدید با لینک شما عضو ربات شد!",
                    'ignore' => true,
                ]);
            }
        }
        return $this->start();
    }

}
