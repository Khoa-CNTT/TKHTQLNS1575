<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanLyHopDong extends Model
{
    use HasFactory;
    protected $table = 'quan_ly_hop_dongs';
    protected $fillable = [
        'id_nhan_vien', 
        'loai_hop_dong',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'luong_co_ban',
        'trang_thai'
    ];
}
