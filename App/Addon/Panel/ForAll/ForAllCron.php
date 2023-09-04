<?php
#auto-name
namespace App\Addon\Panel\ForAll;

use Models\User;

class ForAllCron
{

    public static function handle()
    {

        set_time_limit(30);

        $startTime = time();
        $queue = Models\ForAllQueue::query()->get();

        if(!$queue)
            return;

        $args = $queue->args;
        $args['ignore'] = true;
        $method = $queue->method;

        // Timer loop
        while(time() - $startTime < 20)
        {
            sleep(1);
            // Get next users
            $users = User::query()->offset($queue->offset)->limit(50)->pluck('id');
            // Finish queue
            if(!$users)
            {
                $queue->delete();
                return;
            }
            // Send to users
            foreach($users as $userid)
            {
                $args['chat'] = $userid;
                mmb()->$method($args);
            }
            $queue->offset += count($users);
        }

        $queue->save();

    }
    
}
