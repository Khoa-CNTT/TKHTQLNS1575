<?php

namespace App\Http\Controllers;

use App\Models\BangChucDanh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BangChucDanhController extends Controller
{
    public function getBangChucDanh(Request $request)
    {
        $query = BangChucDanh::leftJoin('nhan_viens', 'bang_chuc_danhs.id_chuc_danh', '=', 'nhan_viens.id_chuc_danh');

        // Filter by position name if provided
        if ($request->has('ten_chuc_danh') && !empty($request->ten_chuc_danh)) {
            $query->where('bang_chuc_danhs.ten_chuc_danh', 'like', '%' . $request->ten_chuc_danh . '%');
        }

        // Filter by status if provided
        if ($request->has('trang_thai') && $request->trang_thai !== null) {
            $query->where('bang_chuc_danhs.trang_thai', $request->trang_thai);
        }

        $bangChucDanh = $query->select('bang_chuc_danhs.*', DB::raw('COUNT(nhan_viens.id) as so_luong_nhan_vien'))
            ->groupBy(
                'bang_chuc_danhs.id_chuc_danh',
                'bang_chuc_danhs.ten_chuc_danh',
                'bang_chuc_danhs.ban_luong',
                'bang_chuc_danhs.trang_thai',
                'bang_chuc_danhs.created_at',
                'bang_chuc_danhs.updated_at'
            )
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $bangChucDanh
        ], 200);
    }
    public function createBangChucDanh(Request $request)
    {
        $bangChucDanh = BangChucDanh::create([
            'ten_chuc_danh' => $request->ten_chuc_danh,
            'ban_luong' => $request->ban_luong,
            'trang_thai' => $request->trang_thai
        ]);
        return response()->json([
            'status' => 201,
            'data' => $bangChucDanh,
            "message" => "Thêm bằng chức danh thành công"
        ], 201);
    }

    public function updateBangChucDanh(Request $request)
    {
        // Find the record first
        $bangChucDanh = BangChucDanh::find($request->id_chuc_danh);

        if (!$bangChucDanh) {
            return response()->json([
                'status' => 404,
                'message' => "Không tìm thấy chức danh"
            ], 404);
        }

        // Update the record
        $bangChucDanh->update([
            'ten_chuc_danh' => $request->ten_chuc_danh,
            'ban_luong' => $request->ban_luong,
            'trang_thai' => $request->trang_thai
        ]);

        return response()->json([
            'status' => 200,
            'data' => $bangChucDanh,
            "message" => "Cập nhật bằng chức danh thành công"
        ], 200);
    }

    public function deleteBangChucDanh($id)
    {
        $bangChucDanh = BangChucDanh::find($id);
        if (!$bangChucDanh) {
            return response()->json([
                'status' => 404,
                'message' => "Không tìm thấy chức danh"
            ], 404);
        }
        $bangChucDanh->delete();
        return response()->json([
            'status' => 200,
            'message' => "Xóa thành công"
        ], 200);
    }

    public function getBangChucDanhChiTiet($id)
    {
        $bangChucDanh = BangChucDanh::where('id_chuc_danh', $id)->first();
        return response()->json([
            'status' => 200,
            'data' => $bangChucDanh
        ]);
    }
}
