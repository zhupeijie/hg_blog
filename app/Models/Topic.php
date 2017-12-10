<?php

namespace App\Models;

use App\Models\Traits\TopicQuery;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use TopicQuery;

    const IS_DELETE = 1;
    const NOT_DELETE = 0;

    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

    /**
     * The model relation on User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The model relation on Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The model relation on Label.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels()
    {
        return $this->belongsToMany(Label::class, 'topic_label')->withTimestamps();
    }
}
