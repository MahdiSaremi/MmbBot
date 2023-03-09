<?php

namespace Providers; #auto

use Mmb\Controller\Handler\HandlerCurrentStep;
use Mmb\Provider\UpdProvider as Provider;
use Mmb\Controller\Handler\Handler;
use Mmb\Controller\Handler\HandlerStep;
use Mmb\Controller\StepHandler\StepHandler;
use Mmb\Listeners\Listeners;
use Mmb\Update\Chat\Chat;
use Mmb\Update\Chat\JoinReq;
use Mmb\Update\Inline\ChosenInline;
use Mmb\Update\Inline\Inline;
use Mmb\Update\Upd;

class UpdProvider extends Provider
{

    public function register()
    {
    }
    
    
    public function getUpdate()
    {
        return mmb()->getUpd();
    }
    
    public function getHandlers()
    {

        // Set app('step')
        $this->onInstance('step', function () {
            return new HandlerCurrentStep();
        });


        // Find handlers
        if ($handler = $this->findHandler())
        {
            $file = __DIR__ . "/../Handles/$handler.php";
            if (file_exists($file))
            {
                // load handler config
                $this->loadConfigFrom($file, 'handle');

                // Condition
                if(($condition = config('handle.condition')) && !Listeners::callMethod($condition))
                {
                    return [];
                }

                // Return handler list
                return config('handle.handlers');
            }
        }

        return [];

    }

    public function findHandler()
    {
        
        if(Inline::$this)
        {
            return 'inline';
        }
        // if(ChosenInline::$this)
        // {
        //     return 'chosenInline';
        // }
        // if(JoinReq::$this)
        // {
        //     return 'joinReq';
        // }

        if($chat = Chat::$this)
        {
            switch($chat->type)
            {

                case Chat::TYPE_PRIVATE:
                    return 'pv';

                case Chat::TYPE_GROUP:
                case Chat::TYPE_SUPERGROUP:
                    return 'group';

                case Chat::TYPE_CHANNEL:
                    return 'channel';

            }
        }

        return null;

    }

}
