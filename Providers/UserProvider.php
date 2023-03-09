<?php

namespace Providers; #auto
use Mmb\Provider\Provider;
use Mmb\Update\Chat\Chat;
use Mmb\Update\Upd;
use Mmb\Update\User\User;

class UserProvider extends Provider
{
    
    public function boot()
    {

        // Auto save user data
        $this->updateHandled(function () {
            if($user = \Models\User::$this)
            {
                $user->save();
            }
        });

        // Condition: User exists only
        $this->onInstance('user', function() {
            if ($user = \Models\User::$this)
            {
                return $user;
            }
			
			if($user = $this->loadUser())
			{
				return \Models\User::$this = $user;
			}
			
			return false;
        });

        // Condition: Load user if user exists, else run too
        $this->onInstance('user_custom', function() {
            if ($user = \Models\User::$this)
            {
                return $user;
            }

			if($user = $this->loadUser())
			{
				return \Models\User::$this = $user;
			}
			
			return true;
        });

        // Condition: Load user or create it, false in failture
        $this->onInstance('user_or_create', function () {
            if ($user = \Models\User::$this)
            {
                return $user;
            }

			if ($user = $this->loadUser()) ;
			elseif($user = $this->createUser()) ;
			else return false;
			return \Models\User::$this = $user;
        });
    }
	
	public function loadUser()
	{
        if($us = User::$this)
		{
			$user = \Models\User::find($us->id);
			if($user)
			{
				return $user;
			}
		}
		return false;
	}

    public function createUser()
    {
        if($us = User::$this)
		{
			return \Models\User::createUser(User::$this->id);
		}
    }

}
