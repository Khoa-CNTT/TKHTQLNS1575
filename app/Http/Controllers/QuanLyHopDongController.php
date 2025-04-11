<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
class QuanLyHopDongController extends Controller
{

    public function getQuanLyHopDong(Request $request)
    {
        // Lấy tất cả hợp đồng
        $hopDong = \App\Models\QuanLyHopDong::all();

        return response()->json([
            'message' => 'Lấy danh sách hợp đồng thành công',
            'data' => $hopDong
        ], 200);
    }
    public function themQuanLyHopDong(Request $request)
    {
        // Thêm hợp đồng mới
        $hopDong = \App\Models\QuanLyHopDong::create($request->all());

        return response()->json([
            'message' => 'Thêm hợp đồng thành công',
            'data' => $hopDong
        ], 201);
    }
    public function capNhatQuanLyHopDong(Request $request)
    {
        // Cập nhật hợp đồng
        $hopDong = \App\Models\QuanLyHopDong::find($request->id);
        if (!$hopDong) {
            return response()->json([
                'message' => 'Không tìm thấy hợp đồng'
            ], 404);
        }
        $hopDong->update($request->all());

        return response()->json([
            'message' => 'Cập nhật hợp đồng thành công',
            'data' => $hopDong
        ], 200);
    }
    public function xoaQuanLyHopDong($id)
    {
        // Xóa hợp đồng
        $hopDong = \App\Models\QuanLyHopDong::find($id);
        if (!$hopDong) {
            return response()->json([
                'message' => 'Không tìm thấy hợp đồng'
            ], 404);
        }
        $hopDong->delete();

        return response()->json([
            'message' => 'Xóa hợp đồng thành công'
        ], 200);
    }
}
