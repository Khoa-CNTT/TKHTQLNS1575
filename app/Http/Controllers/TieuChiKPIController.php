<?php

namespace App\Http\Controllers;

use App\Exports\ExcelTieuChiKPIExport;
use App\Http\Requests\TieuChiKpiChangeStatusRequest;
use App\Http\Requests\TieuChiKpiCreateRequest;
use App\Http\Requests\TieuChiKpiDeleteRequest;
use App\Http\Requests\TieuChiKpiUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use App\Models\TieuChiKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TieuChiKPIController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 25;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = TieuChiKPI::get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function getDataOpen()
    {
        $id_chuc_nang = 26;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = TieuChiKPI::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }


    public function store(TieuChiKpiCreateRequest $request)
    {
        $id_chuc_nang = 27;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        TieuChiKPI::create([
            'ten_tieu_chi'  => $request->ten_tieu_chi,
            'mo_ta'         => $request->mo_ta,
            'diem'          => $request->diem,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo tiêu chí KPI',
            'noi_dung'          => 'Tiêu chí KPI ' . $request->ten_tieu_chi . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới tiêu chí kpi ' . $request->ten_tieu_chi . ' thành công.',
        ]);
    }
    public function changeStatus(TieuChiKpiChangeStatusRequest $request)
    {
        $id_chuc_nang = 28;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $tieu_chi_kpi = TieuChiKPI::find($request->id);
        if ($tieu_chi_kpi) {
            $tieu_chi_kpi->tinh_trang = !$tieu_chi_kpi->tinh_trang;
        }
        $tieu_chi_kpi->save();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái tiêu chí KPI',
            'noi_dung'          => 'Tiêu chí KPI ' . $request->tieu_chi_kpi . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $tieu_chi_kpi->ten_tieu_chi . ' thành công ',
        ]);
    }
    public function updateTieuChiKPI(TieuChiKpiUpdateRequest $request)
    {
        $id_chuc_nang = 29;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        TieuChiKPI::where('id', $request->id)->update([
            'ten_tieu_chi'  => $request->ten_tieu_chi,
            'mo_ta'         => $request->mo_ta,
            'diem'          => $request->diem,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật tiêu chí KPI',
            'noi_dung'          => 'Tiêu chí KPI ' . $request->ten_tieu_chi . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deleteTieuChiKPI(TieuChiKpiDeleteRequest $request)
    {
        $id_chuc_nang = 30;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        TieuChiKPI::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa tiêu chí KPI',
            'noi_dung'          => 'Phòng ban ' . $request->ten_tieu_chi . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function xuatExcelTieuChiPKI()
    {
        $id_chuc_nang = 31;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = TieuChiKPI::get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu tiêu chí KPI',
            'noi_dung'          => 'Tiêu chí KPI vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);


        return Excel::download(new ExcelTieuChiKPIExport($data), 'tieu_chi_kpi.xlsx');
    }
}
