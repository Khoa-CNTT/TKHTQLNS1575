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
            "ma_vai_tro" => $request->ma_vai_tro,
            "ho_va_ten" => $request->ho_va_ten,
            "ngay_sinh" => $request->ngay_sinh,
            "gioi_tinh" => $request->gioi_tinh,
            "so_dien_thoai" => $request->so_dien_thoai,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "ngay_tuyen_dung" => $request->ngay_tuyen_dung,
            "ma_phong_ban" => $request->ma_phong_ban,
            "ma_chuc_danh" => $request->ma_chuc_danh,
            "trang_thai" => $request->trang_thai,
            "loai_hop_dong" => $request->loai_hop_dong,
            "is_master" => $request->is_master,
        ]);
        return response()->json([
            "message" => "Đăng ký thành công",
            "data" => $nhanVien->makeHidden(['password'])
        ], 201);
    }

    public function dangNhap(Request $request)
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
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}
