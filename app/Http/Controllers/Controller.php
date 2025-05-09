<?php

namespace App\Http\Controllers;

use App\Models\PhanQuyen;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function checkPhanQuyen($id_chuc_nang)
    {
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_chuc_vu', $user_login->id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            abort(response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ], 200));
        }

        return $user_login;
    }
}
