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
    public function getData()
    {
        $id_chuc_nang = 46;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ChiTietHopDong::join('nhan_viens', 'nhan_viens.id', 'chi_tiet_hop_dongs.id_nhan_vien')
            ->join('loai_hop_dongs', 'loai_hop_dongs.id', 'chi_tiet_hop_dongs.id_loai_hop_dong')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(NhanVienCreateHopDongRequest $request)
    {
        $id_chuc_nang = 47;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
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

    public function xuatExcelChiTietHopDong()
    {
        $id_chuc_nang = 48;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ChiTietHopDong::join('nhan_viens', 'nhan_viens.id', 'chi_tiet_hop_dongs.id_nhan_vien')
            ->join('loai_hop_dongs', 'loai_hop_dongs.id', 'chi_tiet_hop_dongs.id_loai_hop_dong')
            ->get();
        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu chi tiết hợp đồng',
            'noi_dung'          => 'Chi tiết hợp đồng vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelChiTietHopDongExport($data), 'chi_tiet_hop_dong.xlsx');
    }
}
