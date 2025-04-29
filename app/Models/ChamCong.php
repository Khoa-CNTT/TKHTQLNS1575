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
        'thoi_gian_cham_cong',
        'trang_thai', // 0: Đúng Giờ, 1: Sai giờ
        'type', // 0: Vào, 1: ra
    ];
    // Ca làm  1 : Sáng , 2: Trưa, 3 Tối

    CONST CHAM_CONG_SAI_GIO     = 1;
    CONST CHAM_CONG_DUNG        = 0;

    CONST CHAM_CONG_VAO         = 0;
    CONST CHAM_CONG_RA          = 1;
}
