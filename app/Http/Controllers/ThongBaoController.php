<?php

namespace App\Http\Controllers;

use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThongBaoController extends Controller
{
    public function getDataThongBao()
    {
        $user = Auth::guard('sanctum')->user();
        if($user) {
            $data = ThongBao::where('id_nhan_vien', $user->id)->orderByDESC('id')->take(10)->get();

            return response()->json([
                'data'    =>  $data,
            ]);
        }
    }

}
