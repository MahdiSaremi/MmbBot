<?php
#auto-name
namespace App\Home\Start;

use App\Home\Home;
use Mmb\Controller\Controller;
use Mmb\Controller\QueryControl\QueryBooter;
use Mmb\Controller\QueryControl\StartControl;
use App\Uploader;
use Mmb\Compile\Attributes\AutoHandle;

class StartController extends Controller
{

    use StartControl;
    #[AutoHandle('pv', offset:25)]
    public function bootStart(QueryBooter $booter)
    {
        $booter->pattern("{id}")
                ->int('id')
                ->invoke('invite');

        $booter->else('start');
    }
    
	public function start()
    {
        return Home::invoke('main');
	}

    public function invite($from, \Models\User $user)
    {
        // if($user->newCreated)
        // {
        //     $user2 = \Models\User::find($from);
        //     if($user2 && $user2->id != $user->id)
        //     {
        //         $user2->newInvite();
        //         mmb()->sendMsg([
        //             'chat' => $user2->id,
        //             'text' => "یک کاربر جدید با لینک شما عضو ربات شد!",
        //             'ignore' => true,
        //         ]);
        //     }
        // }
        return $this->start();
    }

}
