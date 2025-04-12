<?php

namespace App\Http\Controllers;

use App\Exports\ExcelLuongExport;
use App\Exports\ExcelNhanVienExport;
use App\Exports\ExcelTinhLuongTheoThangExport;
use App\Http\Requests\NhanVienChangeStatusRequest;
use App\Http\Requests\NhanVienCreateRequest;
use App\Http\Requests\NhanVienDeleteRequest;
use App\Http\Requests\NhanVienUpdateRequest;
use App\Models\ChamCong;
use App\Models\KpiNhanVien;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use App\Models\ThuongVaPhat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class NhanVienController extends Controller
{

    public function login(Request $request)
    {
        $check  =   Auth::guard('nhanvien')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($check) {
            $nhanVien  =   Auth::guard('nhanvien')->user();
            ThongBao::create([
                'tieu_de'           => 'Đăng nhập',
                'noi_dung'          => 'Bạn vừa đăng nhập thành công',
                'icon_thong_bao'    => 'fa-solid fa-right-to-bracket',
                'color_thong_bao'   => 'text-success',
                'id_nhan_vien'      => $nhanVien->id,
            ]);
            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $nhanVien->createToken('token_nhan_vien')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài khoản hoặc mật khẩu không đúng!",
            ]);
        }

    }
    public function xuatExcelNhanVien()
    {
        $id_chuc_nang = 8;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = NhanVien::join('phong_bans', 'phong_bans.id', 'nhan_viens.id_phong_ban')
            ->join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu', 'phong_bans.ten_phong_ban')
            ->get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        return Excel::download(new ExcelNhanVienExport($data), 'nhan_vien.xlsx');
    }
    public function timKiemNhanVien(Request $request)
    {
        $id_chuc_nang = 3;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = NhanVien::where('ho_va_ten', 'like', '%' . $request->noi_dung . '%')->get();
        return response()->json([
            'data'   => $data,
        ]);
    }
    public function getData()
    {
        $id_chuc_nang = 1;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }

        $data = NhanVien::join('phong_bans', 'phong_bans.id', 'nhan_viens.id_phong_ban')
            ->join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu', 'phong_bans.ten_phong_ban')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(NhanVienCreateRequest $request)
    {
        $id_chuc_nang = 4;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        NhanVien::create([
            'id_phong_ban'          => $request->id_phong_ban,
            'id_chuc_vu'            => $request->id_chuc_vu,
            'ho_va_ten'             => $request->ho_va_ten,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'ngay_sinh'             => $request->ngay_sinh,
            'dia_chi'               => $request->dia_chi,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'luong_co_ban'          => $request->luong_co_ban,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo mới nhân viên',
            'noi_dung'          => 'Nhân viên ' . $request->ho_va_ten . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới nhân viên ' . $request->ho_va_ten . ' thành công.',
        ]);
    }
    public function changeStatus(NhanVienChangeStatusRequest $request)
    {
        $id_chuc_nang = 5;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $nhan_vien = NhanVien::find($request->id);
        if ($nhan_vien) {
            $nhan_vien->is_block = !$nhan_vien->is_block;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái nhân viên',
            'noi_dung'          => 'Nhân viên ' . $request->ho_va_ten . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        $nhan_vien->save();
        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $nhan_vien->ho_va_ten . ' thành công ',
        ]);
    }
    public function updateNhanVien(NhanVienUpdateRequest $request)
    {
        $id_chuc_nang = 6;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        NhanVien::where('id', $request->id)->update([
            'id_phong_ban'          => $request->id_phong_ban,
            'id_chuc_vu'            => $request->id_chuc_vu,
            'ho_va_ten'             => $request->ho_va_ten,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'ngay_sinh'             => $request->ngay_sinh,
            'dia_chi'               => $request->dia_chi,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'luong_co_ban'          => $request->luong_co_ban,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật nhân viên',
            'noi_dung'          => 'Nhân viên ' . $request->ho_va_ten . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deleteNhanVien(NhanVienDeleteRequest $request)
    {
        $id_chuc_nang = 7;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        NhanVien::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa nhân viên',
            'noi_dung'          => 'Nhân viên ' . $request->ho_va_ten . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }
}
