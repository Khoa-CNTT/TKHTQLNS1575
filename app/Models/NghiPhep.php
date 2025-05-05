<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NghiPhep extends Model
{
    use HasFactory;
     protected $table = 'nghi_pheps';

    protected $fillable = [
            'id_nhan_vien',
            'id_loai_vang',
            'ngay_bat_dau',
            'ngay_ket_thuc',
            'so_ngay_vang',
            'ly_do',
            'tinh_trang',
            'nguoi_phe_duyet',
            'ngay_phe_duyet',
            'ghi_chu',
    ];
}

