<?php

namespace App\Models;

use App\Traits\LastActivedAtHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, LastActivedAtHelper;

    /**
     * 是否是已激活状态
     */
    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const SOURCE_GIT_HUB = 'github';
    const SOURCE_WEB = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'name', 'avatar', 'verification_token', 'login_token', 'introduction', 'source'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The model relation on Topic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Is author of the model.
     *
     * @param $model
     * @return bool
     */
    public function isAuthorOf($model)
    {
        return $this->id === $model->user_id;
    }
}
