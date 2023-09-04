<?php
#auto-name
namespace App\Addon\Panel\User\Profile;

use App\Addon\Panel\User\UsersPanel;
use Mmb\Controller\Form\Form;
use Mmb\Controller\Form\FormInput;

class FindUserForm extends Form
{
    
	public function form()
    {
        $this->requiredLoop('id');
	}

    public function id(FormInput $input)
    {
        $input
            ->msg()
            ->options([
                [ $input->optionUser("انتخاب کاربر", false) ],
            ])
            ->request("از یکی از روش های زیر استفاده کنید:\n\n+ شناسه عددی کاربر را ارسال کنید\n+ یک پیام از او را فوروارد کنید\n+ با کمک دکمه زیر کاربر را انتخاب کنید:")
            ->then(function() use($input) {

                $msg = msg();
                if($msg->userShared)
                    $id = $msg->userShared->userId;
                elseif($msg->forwardFrom)
                    $id = $msg->forwardFrom->id;
                elseif(is_numeric($msg->text))
                    $id = $msg->text;
                else
                    $input->error("❌ از یکی از روش ها استفاده کنید");
                
                UserManage::invoke('user', $id);

            });
    }
	
	public function onCancel()
    {
        return UsersPanel::invokeWith("عملیات لغو شد");
	}
	
	public function onFinish()
    {
        // never
	}

}
