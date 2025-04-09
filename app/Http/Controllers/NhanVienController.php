<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NhanVienController extends Controller
{
    public function dangKyNhanVien(Request $request)
    {
        $nhanVien = NhanVien::create([
            "id_vai_tro" => $request->id_vai_tro,
            "ho_va_ten" => $request->ho_va_ten,
            "ngay_sinh" => $request->ngay_sinh,
            "gioi_tinh" => $request->gioi_tinh,
            "so_dien_thoai" => $request->so_dien_thoai,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "ngay_tuyen_dung" => $request->ngay_tuyen_dung,
            "id_phong_ban" => $request->id_phong_ban,
            "id_chuc_danh" => $request->id_chuc_danh,
            "trang_thai" => $request->trang_thai,
            "loai_hop_dong" => $request->loai_hop_dong,
            "is_master" => $request->is_master,
        ]);
        return response()->json([
            "message" => "Đăng ký thành công",
            "data" => $nhanVien->makeHidden(['password'])
        ], 201);
    }

    public function  dangNhap(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $nhanVien = NhanVien::where('email', $request->email)->first();

        // Check if user exists and password is correct
        if (!$nhanVien || !Hash::check($request->password, $nhanVien->password)) {
            return response()->json([
                'message' => 'Đăng nhập thất bại',
            ], 401);
        }

        // Create token
        $token = $nhanVien->createToken('auth_token')->plainTextToken;

        // Return response with token
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'data' => [
                'chia_khoa' => $token,
                'token_type' => 'Bearer',
                "data"=>$nhanVien
            ]
        ]);
    }

    public function kiemTraChiaKhoa()
    {
        $check  = $this->isUserNhanVien();

        if ($check) {
            return response()->json([
                'status' => 200,
                'message' => 'Ok, bạn có thể đi qua!',
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn chưa đăng nhập!',
            ]);
        }
    }

    public function thongTin()
    {
        $nhan_vien = Auth::guard('sanctum')->user();

        return response()->json([
            'data' => $nhan_vien
        ]);
    }
    public function updateThongTin(Request $request)
    {
        $nhan_vien = Auth::guard('sanctum')->user();

        if ($nhan_vien) {
            NhanVien::where('id', $nhan_vien->id)->update([
                'email'             => $request->email,
                'so_dien_thoai'     => $request->so_dien_thoai,
                "ho_va_ten"         => $request->ho_va_ten,
                "ngay_sinh"         => $request->ngay_sinh,
                "gioi_tinh"         => $request->gioi_tinh,
                "ngay_tuyen_dung"   => $request->ngay_tuyen_dung,
                "id_phong_ban"      => $request->id_phong_ban,
                "id_chuc_danh"      => $request->id_chuc_danh,
                "trang_thai"        => $request->trang_thai,
                "loai_hop_dong"     => $request->loai_hop_dong,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Bạn đã cập nhật thông tin thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
    public function updateMatKhau(request $request)
    {
        $nhan_vien = Auth::guard('sanctum')->user();
        // return response()->json($nhan_vien);
        if ($nhan_vien) {
            NhanVien::where('id', $nhan_vien->id)->update([
                'password'             => bcrypt($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => "Bạn đã cập nhật mật khẩu thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

}
