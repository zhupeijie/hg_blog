<?php
/**
 * Created by HanGang.
 * Date: 2017/12/3
 */

namespace App\Traits;

use Redis;
use Carbon\Carbon;

trait LastActivedAtHelper
{
    // 缓存相关
    protected $hashPrefix = 'blog_last_actived_at_';
    protected $fieldPrefix = 'user_';

    /**
     * 记录用户最后一次的登录时间
     */
    public function recordLastActivedAt()
    {
        // 获取今天 Redis 哈希表名称, 如: blog_last_actived_at_2017-12-03
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称, 如: user_1
        $field = $this->getHashField();

        // 当前时间, 如: 2017-12-03 09:00:00
        $now = Carbon::now()->toDateTimeString();

        // 数据写入 Redis , 字段已存在会被更新
        Redis::hSet($hash, $field, $now);
    }

    /**
     * 用户的最后登录时间同步到数据库
     */
    public function syncUserActivedAt()
    {
        // 获取昨天 Redis 哈希表的命名, 如: blog_last_actived_at_2017-12-03
        $hash = $this->getHashFromDateString(Carbon::now()->subDay()->toDateString());

        // 从 Redis 中获取所有哈希表里的数据
        $dates = Redis::hGetAll($hash);

        // 遍历, 并同步到数据库中
        foreach ($dates as $userId => $activedAt) {
            // 会将 `user_1` 转换为 1
            $userId = str_replace($this->fieldPrefix, '', $userId);

            // 只要当用户存在时才更新到数据库中
            if ($user = $this->find($userId)) {
                $user->last_actived_at = $activedAt;
                $user->save();
            }
        }

        // 以数据库为中心的存储, 既已同步, 即可删除
        Redis::del($hash);
    }

    public function getLastActivedAtAttribute($value)
    {
        // 获取今天的日期
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        // 字段名称, 如: user_1
        $field = $this->getHashField();

        // 三元运算符, 优先选择 Redis 数据, 否则使用数据库中
        $dateTime = Redis::hGet($hash, $field) ? : $value;

        // 如果存在的话, 返回时间对应的 Carbon 实体
        if ($dateTime) return new Carbon($dateTime);

        // 否则使用用户注册时间
        return $this->created_at;
    }

    /**
     * @param $date
     * @return string
     */
    private function getHashFromDateString($date)
    {
        // Redis 哈希表的命名, 如 blog_last_actived_at_2017-12-03
        return $this->hashPrefix . $date;
    }

    /**
     * @return string
     */
    private function getHashField()
    {
        // 字段名称, 如 user_1
        return $this->fieldPrefix . $this->id;
    }
}