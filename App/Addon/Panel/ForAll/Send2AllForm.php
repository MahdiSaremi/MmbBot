<?php
#auto-name
namespace App\Addon\Panel\ForAll;
use Mmb\Controller\Form\Form;
use Mmb\Controller\Form\FormInput;

class Send2AllForm extends Form
{

    public function form()
    {
        $this->required('message');
    }

    public function message(FormInput $input)
    {
        $input
            ->msgArgs()
            ->request("پیام خود را ارسال کنید:");
    }

    public function onCancel()
    {
        return ForAllPanel::invokeWith("عملیات لغو شد");
    }

    public function onFinish()
    {
        Models\ForAllQueue::create([
            'method' => 'sendMsg',
            'args' => $this->message,
        ]);

        return ForAllPanel::invokeWith("پیام شما در صف ارسال همگانی قرار گرفت");
    }
    
}
