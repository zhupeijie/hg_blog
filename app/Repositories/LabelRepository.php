<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use App\Models\Label;

class LabelRepository extends BaseRepository
{
    /**
     * Get all label [Search by label name]
     *
     * @param $name
     * @return mixed
     */
    public function getAllLabels($name)
    {
        return Label::select(['id', 'name'])
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }
}