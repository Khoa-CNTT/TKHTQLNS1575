<?php

namespace App\Http\Controllers;

use App\Models\ChamCong;
use App\Models\KpiNhanVien;
use App\Models\PhanQuyen;
use App\Models\ThuongVaPhat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function thongKeChamCong(Request $request)
    {
        $id_chuc_nang = 67;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ChamCong::join('nhan_viens', 'cham_congs.id_nhan_vien', 'nhan_viens.id')
            ->where('cham_congs.ngay_lam_viec', '>=', $request->tu_ngay)
            ->where('cham_congs.ngay_lam_viec', '<=', $request->den_ngay)
            ->select('nhan_viens.ho_va_ten', DB::raw('COUNT(cham_congs.id) as so_luong_ca'))
            ->groupBy('nhan_viens.ho_va_ten')
            ->get();
        $ten_nhan_vien    = [];
        $tong_so_luong_ca = [];
        foreach ($data as $key => $value) {
            array_push($ten_nhan_vien, $value->ho_va_ten);
            array_push($tong_so_luong_ca, $value->so_luong_ca);
        }
        return response()->json([
            'data'                =>  $data,
            'ten_nhan_vien'       =>  $ten_nhan_vien,
            'tong_so_luong_ca'    =>  $tong_so_luong_ca,
        ]);
    }

    public function thongKeKPINhanVien(Request $request)
    {
        $id_chuc_nang = 68;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = KpiNhanVien::join('nhan_viens', 'kpi_nhan_viens.id_nhan_vien', 'nhan_viens.id')
            ->where('kpi_nhan_viens.ngay_danh_gia', '>=', $request->tu_ngay)
            ->where('kpi_nhan_viens.ngay_danh_gia', '<=', $request->den_ngay)
            ->select('nhan_viens.ho_va_ten', DB::raw('SUM(kpi_nhan_viens.diem_duoc_cham) as so_luong_cham'))
            ->groupBy('nhan_viens.ho_va_ten')
            ->get();
        $ten_nhan_vien    = [];
        $tong_so_luong_kpi = [];
        foreach ($data as $key => $value) {
            array_push($ten_nhan_vien, $value->ho_va_ten);
            array_push($tong_so_luong_kpi, $value->so_luong_cham);
        }
        return response()->json([
            'data'                =>  $data,
            'ten_nhan_vien'       =>  $ten_nhan_vien,
            'tong_so_luong_kpi'   =>  $tong_so_luong_kpi,
        ]);
    }

    public function thongKeDiemPhat(Request $request)
    {
        $id_chuc_nang = 69;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ThuongVaPhat::join('nhan_viens', 'thuong_va_phats.id_nhan_vien', 'nhan_viens.id')
            ->join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id')
            ->where('thuong_va_phats.ngay', '>=', $request->tu_ngay)
            ->where('thuong_va_phats.ngay', '<=', $request->den_ngay)
            ->where('quy_dinh_cho_diems.loai_diem', 1)
            ->select('nhan_viens.ho_va_ten', DB::raw('SUM(thuong_va_phats.diem) as so_diem_phat'))
            ->groupBy('nhan_viens.ho_va_ten')
            ->get();
        $ten_nhan_vien      = [];
        $tong_so_diem_phat  = [];
        foreach ($data as $key => $value) {
            array_push($ten_nhan_vien, $value->ho_va_ten);
            array_push($tong_so_diem_phat, $value->so_diem_phat);
        }
        return response()->json([
            'data'                =>  $data,
            'ten_nhan_vien'       =>  $ten_nhan_vien,
            'tong_so_diem_phat'   =>  $tong_so_diem_phat,
        ]);
    }

    public function thongKeDiemThuong(Request $request)
    {
        $id_chuc_nang = 70;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ThuongVaPhat::join('nhan_viens', 'thuong_va_phats.id_nhan_vien', 'nhan_viens.id')
            ->join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id')
            ->where('thuong_va_phats.ngay', '>=', $request->tu_ngay)
            ->where('thuong_va_phats.ngay', '<=', $request->den_ngay)
            ->where('quy_dinh_cho_diems.loai_diem', 0)
            ->select('nhan_viens.ho_va_ten', DB::raw('SUM(thuong_va_phats.diem) as so_diem_thuong'))
            ->groupBy('nhan_viens.ho_va_ten')
            ->get();
        $ten_nhan_vien      = [];
        $tong_so_diem_thuong  = [];
        foreach ($data as $key => $value) {
            array_push($ten_nhan_vien, $value->ho_va_ten);
            array_push($tong_so_diem_thuong, $value->so_diem_thuong);
        }
        return response()->json([
            'data'                =>  $data,
            'ten_nhan_vien'       =>  $ten_nhan_vien,
            'tong_so_diem_thuong' =>  $tong_so_diem_thuong,
        ]);
    }
}
