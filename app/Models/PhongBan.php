<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;
    protected $table = 'phong_bans';
    protected $primaryKey = 'id_phong_ban';
    protected $fillable = [
        'ten_phong_ban',
        'ten_truong_phong',
        'ma_phong_ban_cha',
        'trang_thai',
    ];
}
