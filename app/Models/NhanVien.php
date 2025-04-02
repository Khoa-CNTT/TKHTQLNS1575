<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = 'nhan_viens';
    protected $fillable = [
        'ma_vai_tro',
        'ho_va_ten',
        'ngay_sinh',
        'gioi_tinh',
        'so_dien_thoai',
        'email',
        'password',
        'ngay_tuyen_dung',
        'ma_phong_ban',
        'ma_chuc_danh',
        'trang_thai',
        'loai_hop_dong'
    ];
}