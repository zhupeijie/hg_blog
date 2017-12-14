<?php
/**
 * Created by HanGang.
 * Date: 2017/12/14
 */

namespace App\Observers;


use App\Models\Label;

class LabelObserver
{
    public function saving(Label $label)
    {
        // 指定默认的标签图标
        if (empty($label->image)) {
            $label->image = '/images/labels/default.jpeg';
        }
    }
}