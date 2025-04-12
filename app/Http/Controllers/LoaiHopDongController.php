<?php

namespace App\Http\Controllers;

use App\Exports\ExcelLoaiHopDongExport;
use App\Http\Requests\LoaiHopDongChangeStatusRequest;
use App\Http\Requests\LoaiHopDongCreateRequest;
use App\Http\Requests\LoaiHopDongDeleteRequest;
use App\Http\Requests\LoaiHopDongUpdateRequest;
use App\Models\LoaiHopDong;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LoaiHopDongController extends Controller
{
public function getDataOpen()
    {
        $id_chuc_nang = 40;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = LoaiHopDong::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
