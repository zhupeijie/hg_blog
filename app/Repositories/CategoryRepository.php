<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use App\Models\Category;
use App\Models\Label;

class CategoryRepository extends BaseRepository
{
    /**
     * Get all categories
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * Sync topics count under category
     *
     * @param $topic
     * @param $newCategoryId
     * @return bool
     */
    public function syncTopicsCount($topic, $newCategoryId)
    {
        if ($topic->category_id !== $newCategoryId) {
            Category::where('id', $topic->category_id)->decrement('topics_count');
            Category::where('id', $newCategoryId)->increment('topics_count');
        }

        return true;
    }
}