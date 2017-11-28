<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组 如: [1, 2, 3, 4]
        $userIds = User::all()->pluck('id')->toArray();

        // 所有分类 ID 数组 如: [1, 2, 3, 4]
        $categoryIds = Category::all()->pluck('id')->toArray();

        // 获得 faker 实例
        $faker = app(\Faker\Generator::class);

        $topics = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(function ($topic, $index) use ($userIds, $categoryIds, $faker) {
                $topic->user_id = $faker->randomElement($userIds);
                $topic->category_id = $faker->randomElement($categoryIds);
                $topic->last_reply_user_id = $faker->randomElement($userIds);
            });

        // 将数据集合转换为数组, 并插入到数据库中
        Topic::insert($topics->toArray());
    }
}
