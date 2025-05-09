<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    use HasFactory;
    protected $table = 'chuc_vus';

    protected $fillable = [
        'ten_chuc_vu',
        'tinh_trang',
        'id_chuc_vu_cha'
    ];
}
