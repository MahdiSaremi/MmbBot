<?php
#auto-name
namespace App\Addon\Panel\User\Profile;

use Mmb\Compile\Attributes\AutoHandle;
use Mmb\Controller\Controller;
use Mmb\Controller\QueryControl\CallbackControl;
use Mmb\Controller\QueryControl\QueryBooter;
use Models\User;

class UserManage extends Controller
{

    use CallbackControl;
    #[AutoHandle('pv')]
    public function bootCallback(QueryBooter $booter)
    {
        $booter->pattern(".user:{id}")
                ->int('id')
                ->invoke('user');

        $booter->pattern(".user:{method}:{id}")
                ->filter('method', [ 'ban', 'unban', 'promote', 'restrict' ])
                ->int('id');
    }

    public function init($id, ?User &$user)
    {
        if($user = User::find($id))
            return true;

        response("کاربر یافت نشد!");
    }

    /**
     * نمایش اطلاعات کاربر
     *
     * @param int $id
     * @return void
     */
    public function user($id)
    {
        return $this->userShow($id, true);
    }

    public function userShow($id, $forceReply = false)
    {
        if($this->init($id, $user))
        {
            $method = $forceReply || !callback() ? 'response' : 'editText';
            
            $method("
👤 کاربر {$id}


🚫 وضعیت بن : ".($user->ban ? "بن" : "آزاد")."

👨🏻‍💻 نقش : ".$user->role->fa."
            ", [
                'key' => [
                    [
                        $user->ban ?
                            static::keyInline("⚪️ آزاد کردن", 'unban', $id) :
                            static::keyInline("🚫 بن کردن", 'ban', $id),
                    ],
                    [
                        !$this->allow('manage_admins') ? null :
                        ($user->role->access_panel ?
                            static::keyInline("👨‍💼 برکناری از ادمینی", 'restrict', $id) :
                            static::keyInline("👨‍💻 ترفیع به ادمین", 'promote', $id)),
                    ],
                ],
                'ignore' => true,
            ]);
        }
    }

    /**
     * بن کردن کاربر
     *
     * @param int $id
     * @return void
     */
    public function ban($id)
    {
        if($this->init($id, $user))
        {
            answer("🚫 کاربر بن شد", true);
            $user->ban = true;
            $user->save();
            $this->userShow($id);
        }
    }

    /**
     * آنبن کردن کاربر
     *
     * @param int $id
     * @return void
     */
    public function unban($id)
    {
        if($this->init($id, $user))
        {
            answer("✅ کاربر آزاد شد", true);
            $user->ban = false;
            $user->save();
            $this->userShow($id);
        }
    }

    /**
     * ارتقا به ادمینی
     *
     * @param int $id
     * @return void
     */
    public function promote($id)
    {
        if($this->allow('manage_admins') && $this->init($id, $user))
        {
            answer("✅ کاربر ادمین شد", true);
            $user->setRole('admin');
            $user->save();
            $this->userShow($id);
        }
    }

    /**
     * نزول رتبه از ادمینی
     *
     * @param int $id
     * @return void
     */
    public function restrict($id)
    {
        if($this->allow('manage_admins') && $this->init($id, $user))
        {
            answer("✅ کاربر نزول رتبه یافت", true);
            $user->setRole('default');
            $user->save();
            $this->userShow($id);
        }
    }
    
}
