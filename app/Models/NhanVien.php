<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NhanVien extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

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
        'loai_hop_dong',
        'is_master'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
