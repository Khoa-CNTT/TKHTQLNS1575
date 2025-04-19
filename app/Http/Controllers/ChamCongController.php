<?php

namespace App\Http\Controllers;

use App\Exports\ExcelChamCongExport;
use App\Http\Requests\ChamCongCreateRequest;
use App\Http\Requests\ChamCongDeleteRequest;
use App\Http\Requests\ChamCongUpdateRequest;
use App\Models\ChamCong;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ChamCongController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 56;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        $data = ChamCong::join('nhan_viens', 'cham_congs.id_nhan_vien', 'nhan_viens.id')
            ->join('phong_bans', 'nhan_viens.id_phong_ban', 'phong_bans.id')
            ->select('cham_congs.*', 'nhan_viens.ho_va_ten','phong_bans.ten_phong_ban',)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(ChamCongCreateRequest $request)
    {
        $id_chuc_nang = 57;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        ChamCong::create([
            'id_nhan_vien'      => $request->id_nhan_vien,
            'ngay_lam_viec'     => $request->ngay_lam_viec,
            'ca_lam'            => $request->ca_lam,
        ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo chấm công',
            'noi_dung'          => 'Chấm công vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới thành công',
        ]);
    }
    public function updateChamCong(ChamCongUpdateRequest $request)
    {
        $id_chuc_nang = 59;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        $cham_cong = ChamCong::where('id', $request->id)->first();
        if (!$cham_cong) {
            return response()->json([
                'status' => false,
                'message' => 'Chấm công không tồn tại',
            ]);
        }
        ChamCong::where('id', $request->id)
            ->update([
                'id_nhan_vien'      => $request->id_nhan_vien,
                'ngay_lam_viec'     => $request->ngay_lam_viec,
                'ca_lam'            => $request->ca_lam,
            ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật chấm công',
            'noi_dung'          => 'Chấm công vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã update thành công',
        ]);
    }
    public function deleteChamCong(ChamCongDeleteRequest $request)
    {
        $id_chuc_nang = 58;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        ChamCong::where('id', $request->id)->delete();
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa chấm công',
            'noi_dung'          => 'Chấm công ' . $request->ten_phong_ban . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function xuatExcelChamCong()
    {
        $id_chuc_nang = 60;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if(!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        $data = ChamCong::join('nhan_viens', 'cham_congs.id_nhan_vien', 'nhan_viens.id')
                        ->join('phong_bans', 'nhan_viens.id_phong_ban', 'phong_bans.id')
                        ->select('cham_congs.*', 'nhan_viens.ho_va_ten', 'phong_bans.ten_phong_ban',)
                        ->get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu chấm công',
            'noi_dung'          => 'Chấm công vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelChamCongExport($data), 'cham_cong.xlsx');
    }

}
