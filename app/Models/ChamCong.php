<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamCong extends Model
{
    use HasFactory;

    protected $table = 'cham_congs';

    protected $fillable = [
        'id_nhan_vien',
        'ngay_lam_viec',
        'ca_lam',
    ];
    // Ca làm  1 : Sáng , 2: Trưa, 3 Tối
}
