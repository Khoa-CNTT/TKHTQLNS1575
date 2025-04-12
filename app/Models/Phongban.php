<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;
    protected $table = 'phong_bans';
    protected $fillable = [
        'ten_phong_ban',
        'id_phong_ban_cha',
        'id_truong_phong',
        'tinh_trang',
    ];
}
