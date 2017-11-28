<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verification_token')->nullable();
            $table->string('login_token')->nullable();
            $table->string('avatar');
            $table->string('introduction')->nullable()->comment('个人简介');
            $table->tinyInteger('is_active')->unsigned()->default(0);
            $table->integer('topics_count')->unsigned()->default(0)->comment('发布话题数');
            $table->integer('labels_count')->unsigned()->default(0)->comment('标签数');
            $table->integer('replies_count')->unsigned()->default(0)->comment('回复数');
            $table->integer('favorites_count')->unsigned()->default(0)->comment('收藏数');
            $table->integer('likes_count')->unsigned()->default(0)->comment('点赞数');
            $table->integer('followers_count')->unsigned()->default(0)->comment('被关注数');
            $table->integer('followings_count')->unsigned()->default(0)->comment('关注人数');
            $table->integer('notification_count')->unsigned()->default(0)->comment('通知数');
            $table->json('settings')->nullable();
            $table->timestamp('last_actived_at')->nullable()->comment('最后一次登录时间');
            $table->rememberToken();
            $table->tinyInteger('is_delete')->unsigned()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
