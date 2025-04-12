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
    public function getData()
    {
        $id_chuc_nang = 18;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = PhongBan::get();

        return response()->json([
            'data' => $data
        ]);
    }

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

    public function store(CreatePhongBanRequest $request)
    {
        $id_chuc_nang = 20;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        PhongBan::create([
            'ten_phong_ban'     => $request->ten_phong_ban,
            'id_phong_ban_cha'  => $request->id_phong_ban_cha,
            'id_truong_phong'   => $request->id_truong_phong,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo phòng ban',
            'noi_dung'          => 'Phòng ban ' . $request->ten_phong_ban . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới phòng ban ' . $request->ten_phong_ban . ' thành công.',
        ]);
    }
    public function changeStatus(PhongBanChangeStatusRequest $request)
    {
        $id_chuc_nang = 21;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $phong_ban = PhongBan::find($request->id);
        if ($phong_ban) {
            $phong_ban->tinh_trang = !$phong_ban->tinh_trang;
        }
        $phong_ban->save();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái phòng ban',
            'noi_dung'          => 'Phòng ban ' . $request->ten_phong_ban . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $phong_ban->ten_phong_ban . ' thành công ',
        ]);
    }
    public function updatePhongBan(PhongBanUpdateRequest $request)
    {
        $id_chuc_nang = 22;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        PhongBan::where('id', $request->id)->update([
            'ten_phong_ban'     => $request->ten_phong_ban,
            'id_phong_ban_cha'  => $request->id_phong_ban_cha,
            'id_truong_phong'   => $request->id_truong_phong,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật phòng ban',
            'noi_dung'          => 'Phòng ban ' . $request->ten_phong_ban . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deletePhongBan(PhongBanDeleteRequest $request)
    {
        $id_chuc_nang = 23;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        PhongBan::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa phòng ban',
            'noi_dung'          => 'Phòng ban ' . $request->ten_phong_ban . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function xuatExcelPhongBan()
    {
        $id_chuc_nang = 24;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = PhongBan::get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu phòng ban',
            'noi_dung'          => 'Phòng ban vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelPhongBanExport($data), 'phong_ban.xlsx');
    }
}
