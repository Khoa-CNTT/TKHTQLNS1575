<?php

namespace App\Http\Controllers;

use App\Exports\ExcelChucVuExport;
use App\Http\Requests\ChucVuChangeStatusRequest;
use App\Http\Requests\ChucVuCreateRequest;
use App\Http\Requests\ChucVuDeleteRequest;
use App\Http\Requests\ChucVuUpdateRequest;
use App\Models\ChucVu;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ChucVuController extends Controller
{

    public function xuatExcelChucVu()
    {
        $id_chuc_nang = 17;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ChucVu::get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu chức vụ',
            'noi_dung'          => 'Chức vụ vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelChucVuExport($data), 'chuc_vu.xlsx');
    }
    public function getData()
    {
        $id_chuc_nang = 11;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ChucVu::get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(ChucVuCreateRequest $request)
    {
        $id_chuc_nang = 13;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        ChucVu::create([
            'ten_chuc_vu'   => $request->ten_chuc_vu,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo chức vụ',
            'noi_dung'          => 'Chức vụ ' . $request->ten_chuc_vu . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới chức vụ ' . $request->ten_chuc_vu . ' thành công.',
        ]);
    }
    public function changeStatus(ChucVuChangeStatusRequest $request)
    {
        $id_chuc_nang = 14;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $chuc_vu = ChucVu::find($request->id);
        if ($chuc_vu) {
            $chuc_vu->tinh_trang = !$chuc_vu->tinh_trang;
        }
        $chuc_vu->save();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái chức vụ',
            'noi_dung'          => 'Chức vụ ' . $request->ten_chuc_vu . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $chuc_vu->ten_chuc_vu . ' thành công ',
        ]);
    }
    public function updateChucVu(ChucVuUpdateRequest $request)
    {
        $id_chuc_nang = 15;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        ChucVu::where('id', $request->id)->update([
            'ten_chuc_vu'   => $request->ten_chuc_vu,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật chức vụ',
            'noi_dung'          => 'Chức vụ ' . $request->ten_chuc_vu . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deleteChucVu(ChucVuDeleteRequest $request)
    {
        $id_chuc_nang = 16;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        ChucVu::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa chức vụ',
            'noi_dung'          => 'Chức vụ ' . $request->ten_phong_ban . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-trash-can',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }
      public function getDataOpen()
    {
        $id_chuc_nang = 12;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ChucVu::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
