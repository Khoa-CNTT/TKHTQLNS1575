<?php

namespace App\Http\Controllers;

use App\Models\CaLam;
use App\Models\ChamCong;
use App\Models\NghiPhep;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class NghiPhepController extends Controller
{
    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 72;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data   = NghiPhep::where('id', $request->id)->first();
        if($data) {
            if($data->tinh_trang == 0) {
                $data->tinh_trang = 1;
            } else {
                $data->tinh_trang = 0;
            }
            $data->save();

            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã Đổi Trạng Thái Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Đã Đổi Trạng Thái Thất Bại!'
            ]);
        }
    }
    public function themBaoCaoVang(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }


        $messages = [
            'id_nhan_vien.required' => 'Vui lòng chọn nhân viên',
            'id_nhan_vien.exists' => 'Nhân viên không tồn tại trong hệ thống',
            'id_loai_vang.required' => 'Vui lòng chọn loại vắng',
            'id_loai_vang.exists' => 'Loại vắng không tồn tại trong hệ thống',
            'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu',
            'ngay_bat_dau.date' => 'Ngày bắt đầu không đúng định dạng',
            'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc',
            'ngay_ket_thuc.date' => 'Ngày kết thúc không đúng định dạng',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
            'ly_do.required' => 'Vui lòng nhập lý do',
            'ly_do.max' => 'Lý do không được vượt quá 255 ký tự',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'id_nhan_vien' => 'required|exists:nhan_viens,id',
            'id_loai_vang' => 'required|exists:loai_vangs,id',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'ly_do' => 'required|string|max:255',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors(),
            ], 422);
        }

        $startDate = new \DateTime($request->ngay_bat_dau);
        $endDate = new \DateTime($request->ngay_ket_thuc);

        $interval = date_diff($startDate, $endDate);

        $nghiPhep = NghiPhep::create([
            'id_nhan_vien' => $request->id_nhan_vien,
            'id_loai_vang' => $request->id_loai_vang,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'so_ngay_vang' => $interval->days,
            'ly_do' => $request->ly_do,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Thêm thành công',
            'nghiPhep' => $nghiPhep,
        ], 201);
    }



    public function getBaoCaoVang(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }
        $query = NghiPhep::query();

        // Filter by id_nhan_vien if provided
        if ($request->has('id_nhan_vien') && $request->id_nhan_vien != null) {
            $query->where('id_nhan_vien', $request->id_nhan_vien);
        }

        // Filter by id_loai_vang if provided
        if ($request->has('id_loai_vang') && $request->id_loai_vang != null) {
            $query->where('id_loai_vang', $request->id_loai_vang);
        }

        // Search for records between two dates
        if (
            $request->has('tu_ngay') && $request->tu_ngay != null &&
            $request->has('den_ngay') && $request->den_ngay != null
        ) {
            // Find records where the absence period overlaps with the search period
            $query->where(function ($q) use ($request) {
                // Case 1: Start date falls within search period
                $q->whereBetween('ngay_bat_dau', [$request->tu_ngay, $request->den_ngay])
                    // Case 2: End date falls within search period
                    ->orWhereBetween('ngay_ket_thuc', [$request->tu_ngay, $request->den_ngay])
                    // Case 3: Absence period completely contains search period
                    ->orWhere(function ($query) use ($request) {
                        $query->where('ngay_bat_dau', '<=', $request->tu_ngay)
                            ->where('ngay_ket_thuc', '>=', $request->den_ngay);
                    });
            });
        } else {
            // If only one date is provided, use the existing filters
            if ($request->has('ngay_bat_dau') && $request->ngay_bat_dau != null) {
                $query->whereDate('ngay_bat_dau', '>=', $request->ngay_bat_dau);
            }

            if ($request->has('ngay_ket_thuc') && $request->ngay_ket_thuc != null) {
                $query->whereDate('ngay_ket_thuc', '<=', $request->ngay_ket_thuc);
            }
        }

        // Filter by tinh_trang if provided
        if ($request->has('tinh_trang') && $request->tinh_trang !== null) {
            $query->where('tinh_trang', $request->tinh_trang);
        }

        // Get the results with related data from loai_vangs and nhan_viens tables
        $nghiPhep = $query->join('loai_vangs', 'nghi_pheps.id_loai_vang', '=', 'loai_vangs.id')
            ->join('nhan_viens', 'nghi_pheps.id_nhan_vien', '=', 'nhan_viens.id')
            ->select(
                'nghi_pheps.*',
                'loai_vangs.ten_loai_vang',
                'nhan_viens.ho_va_ten'
            )
            ->get();

        return response()->json([
            'status' => 200,
            'nghiPhep' => $nghiPhep,
        ]);
    }
    public function suaBaoCaoVang(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }
        $nghiPhep = NghiPhep::find($request->id);
        if (!$nghiPhep) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy báo cáo nghỉ phép',
            ], 404);
        }
        $startDate = new \DateTime($request->ngay_bat_dau);
        $endDate = new \DateTime($request->ngay_ket_thuc);

        $interval = date_diff($startDate, $endDate);
        $nghiPhep->update([
            'id_nhan_vien' => $request->id_nhan_vien,
            'id_loai_vang' => $request->id_loai_vang,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'so_ngay_vang' => $interval->days,
            'ly_do' => $request->ly_do,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Sửa thành công',
            'nghiPhep' => $nghiPhep,
        ], 200);
    }

    public function xoaBaoCaoVang($id)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }
        $nghiPhep = NghiPhep::find($id);
        if (!$nghiPhep) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy báo cáo nghỉ phép',
            ], 404);
        }
        $nghiPhep->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa thành công',
        ]);
    }
    public function xuatExcel()
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }

        // Get data with joins
        $data = NghiPhep::join('loai_vangs', 'nghi_pheps.id_loai_vang', '=', 'loai_vangs.id')
            ->join('nhan_viens', 'nghi_pheps.id_nhan_vien', '=', 'nhan_viens.id')
            ->select(
                'nghi_pheps.*',
                'loai_vangs.ten_loai_vang',
                'nhan_viens.ho_va_ten'
            )
            ->get();

        // Add STT (sequence number) to each row
        $stt = 1;
        foreach ($data as $row) {
            $row->stt = $stt++;
        }

        // Create and return the Excel file
        return Excel::download(new \App\Exports\NghiPhepExport($data), 'bao-cao-vang.xlsx');
    }

    public function trangThaiChapNhan(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }
        $nghiPhep = NghiPhep::find($request->id);
        if (!$nghiPhep) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy báo cáo nghỉ phép',
            ], 404);
        }
        if ($nghiPhep->tinh_trang > 0) {
            return response()->json([
                'status' => 400,
                'message' => 'khong the chuyen trang thai duoc',
            ]);
        }
        $nguoi_duyet = NhanVien::where('id', $user_login->id)->first();
        $ca_lam = CaLam::whereTime('gio_vao', '<=', Carbon::now()->format('H:i:s'))
            ->whereTime('gio_ra', '>=', Carbon::now()->format('H:i:s'))
            ->first();
        $time_now = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
        $trang_thai = ChamCong::CHAM_CONG_SAI_GIO;
        ChamCong::insert([
            [
                'id_nhan_vien'         => $nghiPhep->id_nhan_vien,
                'ngay_lam_viec'        => Carbon::now()->format('Y-m-d'),
                'ca_lam'               => $ca_lam->id,
                'thoi_gian_cham_cong'  => $time_now,
                'trang_thai'           => $trang_thai,
                'type'                 => ChamCong::CHAM_CONG_VAO,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id_nhan_vien'         => $nghiPhep->id_nhan_vien,
                'ngay_lam_viec'        => Carbon::now()->format('Y-m-d'),
                'ca_lam'               => $ca_lam->id,
                'thoi_gian_cham_cong'  => $time_now,
                'trang_thai'           => $trang_thai,
                'type'                 => ChamCong::CHAM_CONG_RA,
                'created_at'           => now(),
                'updated_at'           => now(),
            ]
        ]);

        $nghiPhep->update([
            'tinh_trang' => 1,
            'nguoi_phe_diet' => $nguoi_duyet->ho_va_ten,
            'ngay_phe_diet' => now(),
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Chuyen trang thai chap nhan',
            'data' => $nghiPhep,
        ], 200);
    }
    public function getData()
    {
        try {
            $id_chuc_nang = 76;
            $user_login = $this->checkPhanQuyen($id_chuc_nang);

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

