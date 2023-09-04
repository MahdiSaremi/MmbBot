<?php
#auto-name
namespace App\Addon\Panel\ChannelLock\Form;

use App\Addon\Panel\ChannelLock\ChannelLockPanel;
use Mmb\Controller\Form\Form;
use Mmb\Controller\Form\FormInput;
use Mmb\Storage\Settings;

class DelForm extends Form
{

    public function form()
    {
        $this->required('chat');
    }

    public function chat(FormInput $input)
    {
        $input
            ->options(function() use($input)
            {
                return aParse([
                    aIter(function() use($input)
                    {
                        foreach(Settings::get('channels', []) as $index => $ch)
                        {
                            yield [ $input->option("🗑 {$ch['text']} - {$ch['id']}", $index) ];
                        }
                    }),
                ]);
            })
            ->request("کانال را انتخاب کنید:");
    }

    public function onCancel()
    {
        return ChannelLockPanel::invokeWith("عملیات لغو شد");
    }

    public function onFinish()
    {
        Settings::unset('channels.' . $this->chat);
        
        return ChannelLockPanel::invokeWith("✅ حذف شد");
    }

}
