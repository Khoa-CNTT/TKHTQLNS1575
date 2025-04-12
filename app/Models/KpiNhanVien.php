<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiNhanVien extends Model
{
    use HasFactory;
    protected $table = 'kpi_nhan_viens';

    protected $fillable = [
        'id_nhan_vien',
        'id_tieu_chi',
        'diem_duoc_cham',
        'id_nhan_vien_danh_gia',
        'ngay_danh_gia',
    ];
}
