<?php
#auto-name
namespace App\Addon\Panel\ForAll;
use Mmb\Controller\Form\Form;
use Mmb\Controller\Form\FormInput;

class Forward2AllForm extends Form
{

    public function form()
    {
        $this->required('message');
    }

    public function message(FormInput $input)
    {
        $input
            ->msg()
            ->request("پیام خود را ارسال کنید:");
    }

    public function onCancel()
    {
        return ForAllPanel::invokeWith("عملیات لغو شد");
    }

    public function onFinish()
    {
        Models\ForAllQueue::create([
            'method' => 'forwardMsg',
            'args' => [
                'from' => $this->message->from->id,
                'msg' => $this->message->id,
            ],
        ]);

        return ForAllPanel::invokeWith("پیام شما در صف فوروارد همگانی قرار گرفت");
    }
    
}
