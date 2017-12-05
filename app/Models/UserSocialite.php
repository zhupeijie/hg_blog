<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialite extends Model
{
    const SOURCE_GIT_HUB = 'github';

    protected $fillable = [
        'user_id', 'source', 'data'
    ];
}
