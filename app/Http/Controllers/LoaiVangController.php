<?php

namespace App\Http\Controllers;

use App\Models\LoaiVang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoaiVangController extends Controller
{
    public function getLoaiVang()
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }

        $loaiVang = LoaiVang::all();
        return response()->json([
            'status' => 200,
            'loaiVang' => $loaiVang,
        ], 200);
    }
    public function themLoaiVang(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }

        $loaiVang = LoaiVang::create([
            'ten_loai_vang' => $request->ten_loai_vang,
            'diem_duoc_cham' => $request->diem_duoc_cham,
            'tinh_trang' => $request->tinh_trang,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Thêm loại vàng thành công',
            'loaiVang' => $loaiVang,
        ], 201);
    }
    public function suaLoaiVang(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }

        $loaiVang = LoaiVang::find($request->id);
        if (!$loaiVang) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy loại vàng',
            ], 404);
        }

        $loaiVang->update([
            'ten_loai_vang' => $request->ten_loai_vang,
            'diem_duoc_cham' => $request->diem_duoc_cham,
            'tinh_trang' => $request->tinh_trang,

        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Sửa loại vàng thành công',
            'loaiVang' => $loaiVang,
        ], 200);
    }

    public function xoaLoaiVang($id){
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
               'status' => 401,
               'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }
        $loaiVang = LoaiVang::find($id);
        $loaiVang->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa loại vàng thành công',
        ], 200);
    }
}
