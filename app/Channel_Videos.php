<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel_Videos extends Model
{
    // 資料表名稱
    protected $table = 'channel_videos';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位（Mass Assignment）
    protected  $fillable = [
        'title',
        'channel_name',
        'author',
        'user_id',
        'video_id',
        'content',
        'views_num',
        'likes_num',
    ];
}
