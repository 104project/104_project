<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    // 資料表名稱
    protected $table = 'channels';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位（Mass Assignment）
    protected  $fillable = [
        "user_id",
        "channel_name",
        "description",
        "channel_color",
        "photo",
    ];
}
