<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use App\Models\Label;

class LabelRepository
{
    /**
     * 获得所有的标签 [根据标签名称查询]
     *
     * @param $name
     *
     * @return mixed
     */
    public function getAllLabels($name)
    {
        return Label::select(['id', 'name'])
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }
}