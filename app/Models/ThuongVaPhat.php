<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongVaPhat extends Model
{
    use HasFactory;

    protected $table = 'thuong_va_phats';
    protected $fillable = [
        'id_nhan_vien',
        'id_nhan_vien_cho_diem',
        'id_quy_dinh',
        'diem',
        'ly_do',
        'ngay'
    ];
}
