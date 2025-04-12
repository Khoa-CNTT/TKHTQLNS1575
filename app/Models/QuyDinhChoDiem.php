<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDinhChoDiem extends Model
{
    use HasFactory;
    protected $table = 'quy_dinh_cho_diems';

    protected $fillable = [
        'ma_so',
        'noi_dung',
        'so_diem',
        'loai_diem',
        'tinh_trang',
        'ghi_chu',
    ];
}
