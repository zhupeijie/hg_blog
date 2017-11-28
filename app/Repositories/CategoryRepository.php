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
    public function getAllCategories()
    {
        return Category::all();
    }
}