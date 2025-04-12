<?php

namespace App\Http\Controllers;

use App\Exports\ExcelPhongBanExport;
use App\Http\Requests\CreatePhongBanRequest;
use App\Http\Requests\PhongBanChangeStatusRequest;
use App\Http\Requests\PhongBanDeleteRequest;
use App\Http\Requests\PhongBanUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\PhongBan;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PhongBanController extends Controller
{
    public function getDataOpen()
    {
        $id_chuc_nang = 19;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = PhongBan::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }

}
