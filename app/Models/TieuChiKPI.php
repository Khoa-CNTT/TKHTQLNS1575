<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TieuChiKPI extends Model
{
    use HasFactory;

    protected $table = 'tieu_chi_kpis';
    protected $fillable = [
        'ten_tieu_chi',
        'mo_ta',
        'diem',
        'tinh_trang',
    ];
}
