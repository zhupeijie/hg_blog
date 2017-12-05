<?php
/**
 * Created by HanGang.
 * Date: 2017/12/5
 */

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    public function findUserBySourceWhenGithub($user)
    {
         if (!$user) {
             return false;
         }

        return $this->user->where('email', $user['email'])->where('source', User::SOURCE_GIT_HUB)->first();
    }
}