<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictTw extends Model
{
    use HasFactory;

    // 指定資料庫連線名稱
    protected $connection = 'mysql';
    // 資料庫名稱
    protected $table = 'district_tw';
    // 主鍵欄位
    protected $primaryKey = 'id';
    // 主鍵型態
    //protected $keyType = 'int';

    protected $guarded = [];

}
