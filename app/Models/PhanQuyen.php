<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    use HasFactory;

    protected $table = 'phan_quyens';

    protected $fillable = [
        'id_chuc_vu',
        'id_chuc_nang'
    ];
}
