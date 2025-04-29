<?php

namespace App\Http\Controllers;

use App\Models\ConfigIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PSpell\Config;

class ConfigController extends Controller
{
    public function configIP(Request $request)
    {
        $publicIp   = $request->ip();
        $ip         = ConfigIP::where('ip_address', $publicIp)->first();
        if(!$ip) {
            ConfigIP::create([
                'ip_address' => $publicIp
            ]);
        }

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Cập nhật địa chỉ IP thành công!',
            'ip'        =>  $publicIp
        ]);
    }
}
