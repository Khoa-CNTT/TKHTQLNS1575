<?php

namespace App\Http\Controllers;

use App\Models\NghiPhep;
use App\Models\PhanQuyen;
use App\Models\NhanVien;
use App\Models\LoaiVang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NghiPhepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData()
    {
        try {
            $user_login = Auth::guard('sanctum')->user();

            if (!$user_login) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn cần đăng nhập để sử dụng chức năng này!'
                ], 401); // 401 Unauthorized
            }

            $id_chuc_nang = 76;
            $check = PhanQuyen::where('id_nhan_vien', $user_login->id)
                              ->where('id_chuc_nang', $id_chuc_nang)
                              ->first();

            if (!$check) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
                ]);
            }

            // Thử chỉ join một bảng
            $data = NghiPhep::leftJoin('loai_vangs', 'nghi_pheps.id_loai_vang', '=', 'loai_vangs.id')
                ->leftJoin('nhan_viens', 'nghi_pheps.id_nhan_vien', '=', 'nhan_viens.id')
                ->select('nghi_pheps.*', 'loai_vangs.ten_loai_vang', 'nhan_viens.ho_va_ten')
                ->get();
            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            // Log lỗi
            Log::error('NghiPhep getData error: ' . $e->getMessage());

            return response()->json([
                'status'    =>  false,
                'message'   =>  'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user_login = Auth::guard('sanctum')->user();

            if (!$user_login) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn cần đăng nhập để sử dụng chức năng này!'
                ], 401); // 401 Unauthorized
            }

            $id_chuc_nang = 77;
            $check = PhanQuyen::where('id_nhan_vien', $user_login->id)
                              ->where('id_chuc_nang', $id_chuc_nang)
                              ->first();

            if (!$check) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
                ]);
            }

            $startDate = new \DateTime($request->ngay_bat_dau);
             $endDate = new \DateTime($request->ngay_ket_thuc);

        $interval = date_diff($startDate, $endDate);
            $nghi_phep = NghiPhep::create([
                'id_nhan_vien' => $request->id_nhan_vien,
                'id_loai_vang' => $request->id_loai_vang,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
                'so_ngay_vang' => $interval->days + 1,
                'ly_do' => $request->ly_do,
                'tinh_trang' => 0,
                'nguoi_phe_duyet' => null,
                'ngay_phe_duyet' => null,
                'ghi_chu' => $request->ghi_chu,
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã tạo mới nghỉ phép thành công!',
                'data'      =>  $nghi_phep
            ]);
        } catch (\Exception $e) {
            // Log lỗi
            Log::error('NghiPhep store error: ' . $e->getMessage());

            return response()->json([
                'status'    =>  false,
                'message'   =>  'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $user_login = Auth::guard('sanctum')->user();

            if (!$user_login) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn cần đăng nhập để sử dụng chức năng này!'
                ], 401); // 401 Unauthorized
            }

            $id_chuc_nang = 78;
            $check = PhanQuyen::where('id_nhan_vien', $user_login->id)
                              ->where('id_chuc_nang', $id_chuc_nang)
                              ->first();

            if (!$check) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
                ]);
            }

            $nghi_phep = NghiPhep::find($request->id);
            $nghi_phep->update([
                'id_nhan_vien' => $request->id_nhan_vien,
                'id_loai_vang' => $request->id_loai_vang,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
                'so_ngay_vang' => $request->so_ngay_vang,
                'ly_do' => $request->ly_do,
                'tinh_trang' => 0,
                'nguoi_phe_duyet' => $request->nguoi_phe_duyet,
                'ngay_phe_duyet' => $request->ngay_phe_duyet,
                'ghi_chu' => $request->ghi_chu,
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã cập nhật nghỉ phép thành công!',
                'data'      =>  $nghi_phep
            ]);
        } catch (\Exception $e) {
            // Log lỗi
            Log::error('NghiPhep update error: ' . $e->getMessage());

            return response()->json([
                'status'    =>  false,
                'message'   =>  'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $user_login = Auth::guard('sanctum')->user();

            if (!$user_login) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn cần đăng nhập để sử dụng chức năng này!'
                ], 401); // 401 Unauthorized
            }

            $id_chuc_nang = 79;
            $check = PhanQuyen::where('id_nhan_vien', $user_login->id)
                              ->where('id_chuc_nang', $id_chuc_nang)
                              ->first();

            if (!$check) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
                ]);
            }

            $nghi_phep = NghiPhep::find($id);
            if(!$nghi_phep){
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Nghỉ phép không tồn tại!'
                ]);
            }
            $nghi_phep->delete();

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã xóa nghỉ phép thành công!'
            ]);
        } catch (\Exception $e) {
            // Log lỗi
            Log::error('NghiPhep destroy error: ' . $e->getMessage());

            return response()->json([
                'status'    =>  false,
                'message'   =>  'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }
}

