<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30); //影片標題
            $table->string('channel_name',20); //影片分類
            $table->string('author',20); //影片作者
            $table->string('user_id'); //影片作者id(即會員編號)
            $table->string('video_id', 40); //youtube影片ID
            $table->string('content', 150); //影片描述內容
            $table->string('views_num'); //觀看次數
            $table->string('likes_num'); //喜愛次數
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
        Schema::dropIfExists('channel_videos');
    }
}
