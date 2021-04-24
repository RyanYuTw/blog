<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblStatus extends Model
{
    use HasFactory;

    // 指定資料庫連線名稱
    protected $connection = 'mysql';
    // 資料庫名稱
    protected $table = 'tbl_status';
    // 主鍵欄位
    protected $primaryKey = 'id';
    // 主鍵型態
    //protected $keyType = 'int';
    // 是否自動待時間撮
    // public $timestamps = true;

    protected $guarded = [];

}
