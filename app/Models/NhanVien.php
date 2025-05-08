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
        'id_phong_ban',
        'id_chuc_vu',
        'ho_va_ten',
        'email',
        'password',
        'ngay_sinh',
        'dia_chi',
        'so_dien_thoai',
        'luong_co_ban',
        'hash_reset',
        'is_block',
        'is_master',
    ];
}
