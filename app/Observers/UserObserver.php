<?php
/**
 * Created by HanGang.
 * Date: 2017/12/12
 */

namespace App\Observers;


use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        $user->is_active = 1;   // 直接激活账户

        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = '/images/avatars/default.png';
        }
    }
}