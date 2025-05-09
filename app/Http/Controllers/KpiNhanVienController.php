<?php

namespace App\Http\Controllers;

use App\Exports\ExcelKPINhanVienExport;
use App\Http\Requests\CreateKPINhanVienRequest;
use App\Http\Requests\KPINhanVienChamDiemRequest;
use App\Http\Requests\KPINhanVienCreateRequest;
use App\Http\Requests\KPINhanVienDeleteRequest;
use App\Http\Requests\KPINhanVienUpdateRequest;
use App\Http\Requests\UpdateKPINhanVienRequest;
use App\Models\KpiNhanVien;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use App\Models\TieuChiKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KpiNhanVienController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 49;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = KpiNhanVien::join('nhan_viens', 'kpi_nhan_viens.id_nhan_vien', 'nhan_viens.id')
            ->join('nhan_viens as nv', 'kpi_nhan_viens.id_nhan_vien_danh_gia', 'nv.id')
            ->join('tieu_chi_kpis', 'tieu_chi_kpis.id', 'kpi_nhan_viens.id_tieu_chi')
            ->select('kpi_nhan_viens.*', 'nhan_viens.ho_va_ten', 'tieu_chi_kpis.ten_tieu_chi', 'nv.ho_va_ten as ten_nhan_vien_danh_gia')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(KPINhanVienCreateRequest $request)
    {
        $id_chuc_nang = 50;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        KpiNhanVien::create([
            'id_nhan_vien'      => $request->id_nhan_vien,
            'id_tieu_chi'       => $request->id_tieu_chi,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo KPI nhân viên',
            'noi_dung'          => 'KPI nhân viên vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới thành công',
        ]);
    }
    public function chamDiem(KPINhanVienChamDiemRequest $request)
    {
        $id_chuc_nang = 51;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $kpi = TieuChiKPI::where('id', $request->id_tieu_chi)->first();
        if (!$kpi || $kpi->diem < $request->diem_duoc_cham) {
            return response()->json([
                'status' => false,
                'message' => 'Kpi không tồn tại hoặc quá điểm chấm',
            ]);
        } else {
            KpiNhanVien::where('id', $request->id)->update([
                'diem_duoc_cham'      => $request->diem_duoc_cham,
                'ngay_danh_gia'      => Carbon::now(),
            ]);

            // Lưu log
            ThongBao::create([
                'tieu_de'           => 'Tạo chấm điểm KPI nhân viên',
                'noi_dung'          => 'Chấm điểm KPI nhân viên vừa được tạo',
                'icon_thong_bao'    => 'fa-solid fa-star',
                'color_thong_bao'   => 'text-warning',
                'id_nhan_vien'      => $user_login->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Đã update thành công',
            ]);
        }
    }
    public function updateKpiNhanVien(KPINhanVienUpdateRequest $request)
    {
        $id_chuc_nang = 52;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $kpi_nhan_vien = KpiNhanVien::where('id', $request->id)->first();
        if (!$kpi_nhan_vien) {
            return response()->json([
                'status' => false,
                'message' => 'Kpi Nhân Viên không tồn tại',
            ]);
        }
        KpiNhanVien::where('id', $request->id)
            ->update([
                'id_nhan_vien'        => $request->id_nhan_vien,
                'id_tieu_chi'         => $request->id_tieu_chi,
                'diem_duoc_cham'      => $request->diem_duoc_cham,
                'ngay_danh_gia'       => Carbon::now(),
            ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật KPI nhan viên',
            'noi_dung'          => 'KPI nhan viên vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã update thành công',
        ]);
    }
    public function deleteKpiNhanVien(KPINhanVienDeleteRequest $request)
    {
        $id_chuc_nang = 53;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        KpiNhanVien::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa KPI nhan viên ',
            'noi_dung'          => 'KPI nhan viên ' . $request->ten_phong_ban . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }
    public function timKiemKpiNhanVien(Request $request)
    {
        $id_chuc_nang = 54;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = KpiNhanVien::join('nhan_viens', 'kpi_nhan_viens.id_nhan_vien', 'nhan_viens.id')
            ->join('tieu_chi_kpis', 'tieu_chi_kpis.id', 'kpi_nhan_viens.id_tieu_chi')
            ->select('kpi_nhan_viens.*', 'nhan_viens.ho_va_ten', 'tieu_chi_kpis.ten_tieu_chi')
            ->where('ho_va_ten', 'like', '%' . $request->noi_dung . '%')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function xuatExcelKPINhanVien()
    {
        $id_chuc_nang = 55;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = KpiNhanVien::join('nhan_viens', 'kpi_nhan_viens.id_nhan_vien', 'nhan_viens.id')
            ->join('nhan_viens as nv', 'kpi_nhan_viens.id_nhan_vien_danh_gia', 'nv.id')
            ->join('tieu_chi_kpis', 'tieu_chi_kpis.id', 'kpi_nhan_viens.id_tieu_chi')
            ->select('kpi_nhan_viens.*', 'nhan_viens.ho_va_ten', 'tieu_chi_kpis.ten_tieu_chi', 'nv.ho_va_ten as ten_nhan_vien_danh_gia')
            ->get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu KPI nhân viên',
            'noi_dung'          => 'KPI nhân viên vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelKPINhanVienExport($data), 'kpi_nhan_vien.xlsx');
    }
}
