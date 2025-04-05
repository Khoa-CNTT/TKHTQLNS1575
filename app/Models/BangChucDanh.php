<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BangChucDanh extends Model
{
    use HasFactory;
    protected $table = 'bang_chuc_danhs';
    protected $primaryKey = 'id_chuc_danh'; // Set the correct primary key
    protected $fillable = [
        "ten_chuc_danh",
        "ban_luong",
        "trang_thai"
    ];
}
