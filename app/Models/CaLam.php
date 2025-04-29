<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaLam extends Model
{
    protected $table = 'ca_lams';

    protected $fillable = [
        'ten_ca',
        'gio_vao',
        'gio_ra',
        'trang_thai',
    ];
}
