<?php

namespace App\Http\Controllers;

use App\Exports\ExcelChiTietHopDongExport;
use App\Http\Requests\NhanVienCreateHopDongRequest;
use App\Models\ChiTietHopDong;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ChiTietHopDongController extends Controller
{
    public function store(NhanVienCreateHopDongRequest $request)
    {
        $id_chuc_nang = 47;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        ChiTietHopDong::create([
            'id_nhan_vien'          => $request->id,
            'id_loai_hop_dong'      => $request->id_loai_hop_dong,
            'noi_dung'              => $request->noi_dung,
            'ngay_ky'               => $request->ngay_ky,
            'ngay_bat_dau'          => $request->ngay_bat_dau,
            'ngay_ket_thuc'         => $request->ngay_ket_thuc,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo chi tiết hợp đồng',
            'noi_dung'          => 'Chi tiết hợp đồng vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới hợp đồng thành công.',
        ]);
    }
}
