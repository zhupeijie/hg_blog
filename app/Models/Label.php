<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'articles_count'
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_label')->withTimestamps();
    }
}
