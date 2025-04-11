<?php

namespace App\Models;
use App\Models\BaoCaoThongKe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoCaoThongKe extends Model
{
    use HasFactory;
    protected $table = 'bao_cao_thong_kes';
    protected $fillable = [
        'id_nhan_vien',
        'ten_bao_cao',
        'mo_ta',
        'loai_bao_cao',
        'ngay_tao',
        'trang_thai'
    ];
}
