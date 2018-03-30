<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel_Video_Collects extends Model
{
    // 資料表名稱
    protected $table = 'channel_video_collects';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位（Mass Assignment）
    protected  $fillable = [
        'user_id',
        'collect_video_id',
        'tag_color_id',
    ];
}
