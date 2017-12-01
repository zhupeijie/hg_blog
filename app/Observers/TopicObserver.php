<?php
/**
 * Created by HanGang.
 * Date: 2017/11/29
 */

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // HTMLPurifier 过滤
//        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);
    }
}