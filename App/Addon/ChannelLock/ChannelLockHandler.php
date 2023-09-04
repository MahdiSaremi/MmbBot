<?php
#auto-name
namespace App\Addon\ChannelLock;

use Mmb\Compile\Attributes\AutoHandle;
use Mmb\Controller\Handler\Handler;
use Mmb\Storage\Settings;
use Mmb\Tools\Keys;
use Mmb\Update\User\UserInfo;

#[AutoHandle('pv', offset:30)]
class ChannelLockHandler extends Handler
{

    public function checkJoin($chat)
    {
        $member = mmb()->getChatMember([
            'chat' => $chat,
            'user' => UserInfo::$this->id,
            'ignore' => true,
        ]);

        return !$member || $member->isJoin;
    }
    
    public function handle()
    {
        $key = $this->getKey();
        if($key)
        {
            response("برای فعال شدن ربات ابتدا باید عضو کانال های زیر شوید\n\nبعد از عضو شدن، روی /start کلیک کنید:", [
                'key' => $key,
            ]);
            $this->stop();
        }
    }

    public function getKey()
    {
        $channels = Settings::get('channels', []);

        $key = [];
        foreach($channels as $ch)
        {
            $id = $ch['id'];
            if(!$this->checkJoin($id))
            {
                $link = $ch['link'];
                $text = $ch['text'];

                $key[] = [
                    Keys::url($text, $link),
                ];
            }
        }

        return $key;
    }
    
}
