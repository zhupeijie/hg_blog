<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use App\Models\Label;

class LabelRepository extends BaseRepository
{

    protected $aa;
    /**
     * 获得所有的标签 [根据标签名称查询]
     *
     * @param $name
     *
     * @return mixed
     */
    public function getAllLabels($name)
    {
        preg_match('\d+', 123);

        return Label::select(['id', 'name'])
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function est($userId)
    {
        $this->getAllLabels();

        /** @var TYPE_NAME $userId */
        $usreID = 5;


        $uesrId= 11;

    }
}