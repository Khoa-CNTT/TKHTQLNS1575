<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiVang extends Model
{
    use HasFactory;
    protected $table = 'loai_vangs';

    protected $fillable = [
       'ten_loai_vang',
        'diem_duoc_cham',
        'tinh_trang'
    ];
}
