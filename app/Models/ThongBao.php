<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;
    protected $table = 'thong_baos';
    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'icon_thong_bao',
        'color_thong_bao',
        'id_nhan_vien',
    ];
}
