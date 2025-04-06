<?php

namespace App\Http\Controllers;

use App\Models\PhongBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhongBanController extends Controller
{
    public function getPhongBan(Request $request)
    {
        $query = PhongBan::leftJoin('nhan_viens', 'phong_bans.id_phong_ban', '=', 'nhan_viens.id_phong_ban');

        // Filter by department name if provided
        if ($request->has('ten_phong_ban') && !empty($request->ten_phong_ban)) {
            $query->where('phong_bans.ten_phong_ban', 'like', '%' . $request->ten_phong_ban . '%');
        }

        // Filter by status if provided
        if ($request->has('trang_thai') && $request->trang_thai !== null) {
            $query->where('phong_bans.trang_thai', $request->trang_thai);
        }

        $phongBan = $query->select('phong_bans.*', DB::raw('COUNT(nhan_viens.id) as so_luong_nhan_vien'))
            ->groupBy(
                'phong_bans.id_phong_ban',
                'phong_bans.ten_phong_ban',
                'phong_bans.ten_truong_phong',
                'phong_bans.trang_thai',
                'phong_bans.created_at',
                'phong_bans.updated_at'
            )
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $phongBan
        ], 200);
    }
    public function createPhongBan(Request $request)
    {
        $phongBan = PhongBan::create([
            'ten_phong_ban' => $request->ten_phong_ban,
            'ten_truong_phong' => $request->ten_truong_phong,
            'trang_thai' => $request->trang_thai,
        ]);
        return response()->json([
            'status' => 201,
            'data' => $phongBan
        ], 201);
    }

    public function updatePhongBan(Request $request)
    {
        $phongBan = PhongBan::find($request->id_phong_ban);
        if (!$phongBan) {
            return response()->json([
                'status' => 404,
                'message' => 'Phòng ban không tồn tại'
            ], 404);
        }
        $phongBan->update([
            'ten_phong_ban' => $request->ten_phong_ban,
            'ten_truong_phong' => $request->ten_truong_phong,
            'trang_thai' => $request->trang_thai,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật phòng ban thành công',
            'data' => $phongBan->makeHidden(['id_phong_ban'])
        ], 200);
    }

    public function deletePhongBan($id)
    {
        $phongBan = PhongBan::find($id);
        if (!$phongBan) {
            return response()->json([
                'status' => 404,
                'message' => 'Phòng ban không tồn tại'
            ], 404);
        }
        $phongBan->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa phòng ban thành công'
        ], 200);
    }
}
