<?php

namespace App\Http\Controllers;

use App\Models\CaLam;
use App\Models\ChamCong;
use App\Models\NghiPhep;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class NghiPhepController extends Controller
{
    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 80;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data   = NghiPhep::where('id', $request->id)->first();

        $start = Carbon::parse($data->ngay_bat_dau);
        $end = Carbon::parse($data->ngay_ket_thuc);
        ChamCong::where('id_nhan_vien', $data->id_nhan_vien)
                ->whereBetween('ngay_lam_viec', [$start, $end])
                ->delete();
        // Tạo danh sách các ngày
        $period = CarbonPeriod::create($start, $end);
        if($data) {
            if($data->id_loai_vang == 1 && $data->tinh_trang == 0) { // Đi công tác
                $ca_lam = CaLam::whereIn('id', [1])->get();
                $dates = [];
                foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }
                $list_ca_lam = [];
                foreach($dates as $key => $value) {
                    foreach($ca_lam as $item) {
                        $list_ca_lam[] = [
                            'id_nhan_vien'          => $data->id_nhan_vien,
                            'ngay_lam_viec'         => $value,
                            'ca_lam'                => $item->id,
                            'thoi_gian_cham_cong'   => $value . ' ' . $item->gio_vao,
                            'trang_thai'            => 0, // 0: Đúng Giờ, 1: Sai giờ
                            'type'                  => 0,
                        ];
                        $list_ca_lam[] = [
                            'id_nhan_vien'          => $data->id_nhan_vien,
                            'ngay_lam_viec'         => $value,
                            'ca_lam'                => $item->id,
                            'thoi_gian_cham_cong'   => $value . ' ' . $item->gio_ra,
                            'trang_thai'            => 0, // 0: Đúng Giờ, 1: Sai giờ
                            'type'                  => 1,
                        ];
                    }
                }

                DB::table('cham_congs')->insert($list_ca_lam);
                if($data->tinh_trang == 0) {
                    $data->tinh_trang = 1;
                } else {
                    $data->tinh_trang = 0;
                }
                $data->save();
            }else{
                if($data->tinh_trang == 0) {
                    $data->tinh_trang = 1;
                } else {
                    $data->tinh_trang = 0;
                }
                $data->save();
            }



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
    public function getBaoCaoVangNV(Request $request)
    {
        $id_chuc_nang = 76;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }

        $query = NghiPhep::query()
            ->join('loai_vangs', 'nghi_pheps.id_loai_vang', '=', 'loai_vangs.id')
            ->join('nhan_viens', 'nghi_pheps.id_nhan_vien', '=', 'nhan_viens.id');

        // Filter by id_nhan_vien if provided
        if ($request->filled('id_nhan_vien')) {
            $query->where('nghi_pheps.id_nhan_vien', $request->id_nhan_vien);
        }

        // Filter by id_loai_vang if provided
        if ($request->filled('id_loai_vang')) {
            $query->where('nghi_pheps.id_loai_vang', $request->id_loai_vang);
        }

        // Filter by date range
        if ($request->filled('tu_ngay') && $request->filled('den_ngay')) {
            $query->where(function ($q) use ($request) {
                $q->whereBetween('nghi_pheps.ngay_bat_dau', [$request->tu_ngay, $request->den_ngay])
                    ->orWhereBetween('nghi_pheps.ngay_ket_thuc', [$request->tu_ngay, $request->den_ngay])
                    ->orWhere(function ($sub) use ($request) {
                        $sub->where('nghi_pheps.ngay_bat_dau', '<=', $request->tu_ngay)
                            ->where('nghi_pheps.ngay_ket_thuc', '>=', $request->den_ngay);
                    });
            });
        } else {
            if ($request->filled('ngay_bat_dau')) {
                $query->whereDate('nghi_pheps.ngay_bat_dau', '>=', $request->ngay_bat_dau);
            }

            if ($request->filled('ngay_ket_thuc')) {
                $query->whereDate('nghi_pheps.ngay_ket_thuc', '<=', $request->ngay_ket_thuc);
            }
        }

        // Filter by tinh_trang if provided
        if ($request->filled('tinh_trang')) {
            $query->where('nghi_pheps.tinh_trang', $request->tinh_trang);
        }

        // Select fields explicitly
        $nghiPhep = $query->select(
            'nghi_pheps.*',
            'loai_vangs.ten_loai_vang',
            'nhan_viens.ho_va_ten'
        )->where('nghi_pheps.id_nhan_vien', $user_login->id)
            ->get();

        if (!$nghiPhep) {
            return response()->json([
                'status' => 200,
                'nghiPhep' => []
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'nghiPhep' => $nghiPhep,
        ]);
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
            'id_nhan_vien' => $user_login->id,
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
    public function themBaoCaoVangDiCongTac(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }


        $messages = [
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
            'id_nhan_vien' => $user_login->id,
            'id_loai_vang' => $request->id_loai_vang,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'so_ngay_vang' => $interval->days +1,
            'ly_do' => $request->ly_do,151
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Thêm thành công',
            'nghiPhep' => $nghiPhep,
        ], 201);
    }
    public function createBaoCaoVang(Request $request)
    {
        $id_chuc_nang = 77;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        if (!$user_login) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn không có quyền truy cập',
            ], 401);
        }


        $messages = [
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
            'id_nhan_vien' => $user_login->id,
            'id_loai_vang' => $request->id_loai_vang,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'so_ngay_vang' => $interval->days + 1,
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

        $query = NghiPhep::query()
            ->join('loai_vangs', 'nghi_pheps.id_loai_vang', '=', 'loai_vangs.id')
            ->join('nhan_viens', 'nghi_pheps.id_nhan_vien', '=', 'nhan_viens.id');

        // Filter by id_nhan_vien if provided
        if ($request->filled('id_nhan_vien')) {
            $query->where('nghi_pheps.id_nhan_vien', $request->id_nhan_vien);
        }

        // Filter by id_loai_vang if provided
        if ($request->filled('id_loai_vang')) {
            $query->where('nghi_pheps.id_loai_vang', $request->id_loai_vang);
        }

        // Filter by date range
        if ($request->filled('tu_ngay') && $request->filled('den_ngay')) {
            $query->where(function ($q) use ($request) {
                $q->whereBetween('nghi_pheps.ngay_bat_dau', [$request->tu_ngay, $request->den_ngay])
                    ->orWhereBetween('nghi_pheps.ngay_ket_thuc', [$request->tu_ngay, $request->den_ngay])
                    ->orWhere(function ($sub) use ($request) {
                        $sub->where('nghi_pheps.ngay_bat_dau', '<=', $request->tu_ngay)
                            ->where('nghi_pheps.ngay_ket_thuc', '>=', $request->den_ngay);
                    });
            });
        } else {
            if ($request->filled('ngay_bat_dau')) {
                $query->whereDate('nghi_pheps.ngay_bat_dau', '>=', $request->ngay_bat_dau);
            }

            if ($request->filled('ngay_ket_thuc')) {
                $query->whereDate('nghi_pheps.ngay_ket_thuc', '<=', $request->ngay_ket_thuc);
            }
        }

        // Filter by tinh_trang if provided
        if ($request->filled('tinh_trang')) {
            $query->where('nghi_pheps.tinh_trang', $request->tinh_trang);
        }

        // Select fields explicitly
        $nghiPhep = $query->select(
            'nghi_pheps.*',
            'loai_vangs.ten_loai_vang',
            'nhan_viens.ho_va_ten'
        )->where('nghi_pheps.id_nhan_vien', $user_login->id)
            ->get();

        if (!$nghiPhep) {
            return response()->json([
                'status' => 200,
                'nghiPhep' => []
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'nghiPhep' => $nghiPhep,
        ]);
    }
    public function suaBaoCaoVang(Request $request)
    {
        $id_chuc_nang = 78;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
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
    public function suaBaoCaoVangNV(Request $request)
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
        $id_chuc_nang = 79;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
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
    public function xoaBaoCaoVangNV($id)
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


    public function store(Request $request)
    {
        try {


            $id_chuc_nang = 77;
            $user_login = $this->checkPhanQuyen($id_chuc_nang);

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




    public function trangThaiTuChoi(Request $request)
    {
        try {
            $user_login = Auth::guard('sanctum')->user();

            if (!$user_login) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Bạn cần đăng nhập để sử dụng chức năng này!'
                ], 401); // 401 Unauthorized
            }
            $nghi_phep = NghiPhep::find($request->id);
            if (!$nghi_phep) {
                return response()->json([
                    'status'    =>  404,
                    'message'   =>  'Nghị phép khong ton tai!'
                ]);
            }
            $nghi_phep->update([
                'tinh_trang' => 2,
                'nguoi_phe_duyet' => $request->nguoi_phe_duyet,
                'ngay_phe_duyet' => now(),
            ]);

            return response()->json([
                'status'    =>  200,
                'message'   =>  'Đã cập nhật nghị phép thành cong!',
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
}
