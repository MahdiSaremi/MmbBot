<?php
#auto-name
namespace App\Addon\Panel\ChannelLock\Form;

use App\Addon\Panel\ChannelLock\ChannelLockPanel;
use Mmb\Controller\Form\Form;
use Mmb\Controller\Form\FormInput;
use Mmb\Storage\Settings;

class AddForm extends Form
{

    public function form()
    {
        $this->required('chat');
        $this->required('title');
    }

    public function chat(FormInput $input)
    {
        $input
            ->msg()
            ->filled(function() use($input) {
                $msg = msg();
                if($msg->forwardFrom)
                    $input->value($msg->forwardFrom->id);
                elseif($msg->forwardChat)
                    $input->value($msg->forwardChat->id);
                elseif(preg_match('/^@[a-zA-Z0-9_]+|\-\d+$/', $msg->text))
                    $input->value($msg->text);
                else
                    $input->error("از یکی از روش های گفته شده استفاده کنید !");
            })
            ->request("یک پیام از کانال فوروارد کنید یا آیدی آن را ارسال کنید")

            ->then(function() use ($input) {
                $chat = mmb()->getChat([
                    'chat' => $input->value(),
                    'ignore' => true,
                ]);

                if(!$chat)
                    $input->error("❌ کانال یافت نشد!");

                $url = optional($chat->createInviteLink([ 'ignore' => true ]))->link;
                if(!$url)
                {
                    if(startsWith($input->value(), '@'))
                        $url = 'https://t.me/' . substr($input->value(), 1);
                    else
                        $input->error("❌ خطایی در ساخت لینک رخ داد! از آیدی عمومی استفاده کنید");
                }
                $this->set('url', $url);

                $input->value($chat->id);
                $this->temp_title = $chat->title;
            });
    }

    public function title(FormInput $input)
    {
        $input
            ->textSingleLine()
            ->options(function() use($input) {
                if($this->temp_title)
                    return [
                        [ $input->option($this->temp_title) ],
                    ];
                else
                    return [];
            })
            ->request("عنوان قفل را وارد کنید:");
    }
	
    public function onCancel()
    {
        return ChannelLockPanel::invokeWith("عملیات لغو شد");
    }

    public function onFinish()
    {
        Settings::set('channels.+', [
            'id' => $this->chat,
            'link' => $this->url,
            'text' => $this->title,
        ]);

        return ChannelLockPanel::invokeWith("✅ افزوده شد");
    }

}
