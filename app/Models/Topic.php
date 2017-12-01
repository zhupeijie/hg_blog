<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    const IS_DELETE = 1;
    const NOT_DELETE = 0;

    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug', 'user_id', 'last_reply_user_id'
    ];

    /**
     * The Model RelationShip On User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Model RelationShip On Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'topic_label')->withTimestamps();
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent' :
                $query = $this->recent();
                break;
            default :
                $query = $this->recentReplied();
                break;
        }

        return $query;
    }

    /**
     * 以更新时间倒序排序
     *
     * @param $query
     * @return mixed
     */
    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->latest('updated_at');
    }

    /**
     * 以创建时间倒序排序
     *
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * 过滤已删除的
     *
     * @param $query
     * @return mixed
     */
    public function scopeUndeleted($query)
    {
        return $query->where('is_delete', 0);
    }

    /**
     * 过滤隐藏的
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_hidden', 0);
    }
}
