<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHopDong extends Model
{
    use HasFactory;

    protected $table = 'loai_hop_dongs';

    protected $fillable = [
        'ten_hop_dong',
        'noi_dung',
        'tinh_trang',
    ];
}
