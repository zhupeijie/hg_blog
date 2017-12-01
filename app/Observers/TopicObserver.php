<?php
/**
 * Created by HanGang.
 * Date: 2017/11/29
 */

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Topic;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // XSS 过滤
//        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {
            // 推送任务到队列中
            dispatch(new TranslateSlug($topic));
        }
    }
}