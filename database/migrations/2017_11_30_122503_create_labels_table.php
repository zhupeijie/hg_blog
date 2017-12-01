<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('标签名称');
            $table->string('image')->nullable();
            $table->text('description')->nullable()->comment('标签描述');
            $table->integer('topics_count')->default(0)->comment('话题数');
            $table->integer('followers_count')->default(0)->comment('关注数');
            $table->tinyInteger('is_delete')->default(0)->index();
            $table->integer('creator')->default(0)->index();
            $table->integer('updater')->default(0)->index();
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
        Schema::dropIfExists('labels');
    }
}
