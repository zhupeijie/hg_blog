<?php
/**
 * Created by HanGang.
 * Date: 2017/12/5
 */

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * The user model instance.
     *
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create an user.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    /**
     * Find user by register source and email.
     *
     * @param $user
     * @param string $source
     * @return bool
     */
    public function findUserBySource($user, $source = User::SOURCE_GIT_HUB)
    {
         if (!$user) {
             return false;
         }

        return $this->user->where('email', $user['email'])->where('source', $source)->first();
    }
}