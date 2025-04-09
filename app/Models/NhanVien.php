<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NhanVien extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'nhan_viens';
    protected $fillable = [
        'id_vai_tro',
        'ho_va_ten',
        'ngay_sinh',
        'gioi_tinh',
        'so_dien_thoai',
        'email',
        'password',
        'ngay_tuyen_dung',
        'id_phong_ban',
        'id_chuc_danh',
        'trang_thai',
        'loai_hop_dong',
        'is_master'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}