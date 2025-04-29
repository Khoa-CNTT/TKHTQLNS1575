<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigIP extends Model
{
    protected $table = 'config_i_p_s';

    protected $fillable = [
        'ip_address',
    ];
}
