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
    public function tinhLuong4(Request $request)
    {
        $id_chuc_nang = 74;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $result = NhanVien::select('id as id_nhan_vien', 'ho_va_ten', 'luong_co_ban')->get();
        for ($i = 1; $i <= 12; $i++) {
            $data = $this->tinhLuongThang($i, $request->year);
            foreach ($result as $key => $value) {
                foreach ($data as $key_1 => $value_1) {
                    if ($value->id_nhan_vien == $value_1->id_nhan_vien) {
                        $thang = "thang_" . $i;
                        $value->$thang = $value_1->tien_luong;
                    }
                }
            }
        }
        return response()->json([
            'data' => $result
        ]);
    }

    public function tinhLuongThang($thang, $nam)
    {
        $begin_day  = Carbon::createFromDate($nam, $thang, 1);
        $end_day    = Carbon::createFromDate($nam, $thang, 1);
        $end_day    = $end_day->endOfMonth();
        $data = ChamCong::select('id_nhan_vien', 'ca_lam', DB::raw("COUNT(ca_lam) as so_buoi"))
            ->groupBy('id_nhan_vien', 'ca_lam')
            ->whereDate('ngay_lam_viec', '>=', $begin_day)
            ->whereDate('ngay_lam_viec', '<=', $end_day)
            ->get();

        $result = NhanVien::select('id as id_nhan_vien', 'ho_va_ten', 'luong_co_ban')->get();

        foreach ($result as $key_2 => $value_2) {
            $value_2->ca_sang  = 0;
            $value_2->ca_chieu = 0;
            $value_2->ca_toi   = 0;
            foreach ($data as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->ca_lam == 1) {
                        $value_2->ca_sang = $value->so_buoi;
                    } else if ($value->ca_lam == 2) {
                        $value_2->ca_chieu = $value->so_buoi;
                    } else {
                        $value_2->ca_toi = $value->so_buoi;
                    }
                }
            }
        }

        $data_2 = ThuongVaPhat::join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id')
            ->select('id_nhan_vien', 'loai_diem', DB::raw("SUM(diem) as tong_diem"))
            ->whereDate('thuong_va_phats.ngay', '>=', $begin_day)
            ->whereDate('thuong_va_phats.ngay', '<=', $end_day)
            ->groupBy('id_nhan_vien', 'loai_diem')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->thuong = 0;
            $value_2->phat   = 0;
            foreach ($data_2 as $key_2 => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->loai_diem == 0) {
                        $value_2->thuong = $value->tong_diem;
                    } else {
                        $value_2->phat = $value->tong_diem;
                    }
                }
            }
        }
        $data_3 = KpiNhanVien::select('id_nhan_vien', DB::raw("SUM(diem_duoc_cham) as tong_diem "))
            ->whereDate('ngay_danh_gia', '>=', $begin_day)
            ->whereDate('ngay_danh_gia', '<=', $end_day)
            ->groupBy('id_nhan_vien')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->diem_KPI = 0;
            foreach ($data_3 as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    $value_2->diem_KPI = $value->tong_diem;
                }
            }
        }
        foreach ($result as $key => $value) {
            $tong_ca        = $value->ca_sang + $value->ca_chieu + $value->ca_toi;
            $tien_thuong    = ($value->thuong - $value->phat) * 10000;
            $tien_kpi       = $value->diem_kpi * 20000;
            $tong_tien      = $tong_ca / 52 * $value->luong_co_ban + $tien_thuong + $tien_kpi;
            $value->tien_luong = number_format(round($tong_tien, -3), 0, ",", ".");
        }
        return $result;
    }
     public function tinhLuong(Request $request)
    {
        $id_chuc_nang = 9;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ChamCong::select('id_nhan_vien', 'ca_lam', DB::raw("COUNT(ca_lam) as so_buoi"))
            ->groupBy('id_nhan_vien', 'ca_lam')
            ->whereDate('ngay_lam_viec', '>=', $request->begin)
            ->whereDate('ngay_lam_viec', '<=', $request->end)
            ->get();

        $result = NhanVien::select('id as id_nhan_vien', 'ho_va_ten', 'luong_co_ban')->get();

        foreach ($result as $key_2 => $value_2) {
            $value_2->ca_sang  = 0;
            $value_2->ca_chieu = 0;
            $value_2->ca_toi   = 0;
            foreach ($data as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->ca_lam == 1) {
                        $value_2->ca_sang = $value->so_buoi;
                    } else if ($value->ca_lam == 2) {
                        $value_2->ca_chieu = $value->so_buoi;
                    } else {
                        $value_2->ca_toi = $value->so_buoi;
                    }
                }
            }
        }

        $data_2 = ThuongVaPhat::join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id')
            ->select('id_nhan_vien', 'loai_diem', DB::raw("SUM(diem) as tong_diem"))
            ->whereDate('thuong_va_phats.ngay', '>=', $request->begin)
            ->whereDate('thuong_va_phats.ngay', '<=', $request->end)
            ->groupBy('id_nhan_vien', 'loai_diem')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->thuong = 0;
            $value_2->phat   = 0;
            foreach ($data_2 as $key_2 => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->loai_diem == 0) {
                        $value_2->thuong = $value->tong_diem;
                    } else {
                        $value_2->phat = $value->tong_diem;
                    }
                }
            }
        }
        $data_3 = KpiNhanVien::select('id_nhan_vien', DB::raw("SUM(diem_duoc_cham) as tong_diem "))
            ->whereDate('ngay_danh_gia', '>=', $request->begin)
            ->whereDate('ngay_danh_gia', '<=', $request->end)
            ->groupBy('id_nhan_vien')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->diem_KPI = 0;
            foreach ($data_3 as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    $value_2->diem_KPI = $value->tong_diem;
                }
            }
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function xuatExcelLuong(Request $request)
    {
        $id_chuc_nang = 10;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        };
        $data = ChamCong::select('id_nhan_vien', 'ca_lam', DB::raw("COUNT(ca_lam) as so_buoi"))
            ->groupBy('id_nhan_vien', 'ca_lam')
            ->whereDate('ngay_lam_viec', '>=', $request->begin)
            ->whereDate('ngay_lam_viec', '<=', $request->end)
            ->get();

        $result = NhanVien::select('id as id_nhan_vien', 'ho_va_ten', 'luong_co_ban')->get();

        foreach ($result as $key_2 => $value_2) {
            $value_2->ca_sang  = 0;
            $value_2->ca_chieu = 0;
            $value_2->ca_toi   = 0;
            foreach ($data as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->ca_lam == 1) {
                        $value_2->ca_sang = $value->so_buoi;
                    } else if ($value->ca_lam == 2) {
                        $value_2->ca_chieu = $value->so_buoi;
                    } else {
                        $value_2->ca_toi = $value->so_buoi;
                    }
                }
            }
        }

        $data_2 = ThuongVaPhat::join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id')
            ->select('id_nhan_vien', 'loai_diem', DB::raw("SUM(diem) as tong_diem"))
            ->whereDate('thuong_va_phats.ngay', '>=', $request->begin)
            ->whereDate('thuong_va_phats.ngay', '<=', $request->end)
            ->groupBy('id_nhan_vien', 'loai_diem')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->thuong = 0;
            $value_2->phat   = 0;
            foreach ($data_2 as $key_2 => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    if ($value->loai_diem == 0) {
                        $value_2->thuong = $value->tong_diem;
                    } else {
                        $value_2->phat = $value->tong_diem;
                    }
                }
            }
        }
        $data_3 = KpiNhanVien::select('id_nhan_vien', DB::raw("SUM(diem_duoc_cham) as tong_diem "))
            ->whereDate('ngay_danh_gia', '>=', $request->begin)
            ->whereDate('ngay_danh_gia', '<=', $request->end)
            ->groupBy('id_nhan_vien')
            ->get();
        foreach ($result as $key_2 => $value_2) {
            $value_2->diem_KPI = 0;
            foreach ($data_3 as $key => $value) {
                if ($value->id_nhan_vien == $value_2->id_nhan_vien) {
                    $value_2->diem_KPI = $value->tong_diem;
                }
            }
        }

        foreach ($result as $key_2 => $value_2) {
            $value_2->tong_so_buoi = ($value_2->ca_sang + $value_2->ca_chieu + $value_2->ca_toi);
            $value_2->diem_thuong_phat = ($value_2->thuong - $value_2->phat);
            $value_2->tien_thuc_nhan =  (($value_2->ca_sang + $value_2->ca_chieu + $value_2->ca_toi) / 24 + ($value_2->thuong - $value_2->phat) * 10000 + ($value_2->diem_KPI * 20000));
        }
        foreach ($result as $key => $value) {
            $value->stt = $key + 1;
        }
        return Excel::download(new ExcelLuongExport($result), 'luong.xlsx');
    }

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
    public function checkLogin()
    {
        $user_login   = Auth::guard('sanctum')->user();
        if ($user_login && $user_login instanceof \App\Models\NhanVien) {
            return response()->json([
                'status'    =>  true
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn cần đăng nhập vào hệ thống trước!'
            ]);
        }
    }
    public function dangXuat()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\NhanVien) {
            DB::table('personal_access_tokens')->where('id', $user->currentAccessToken()->id)->delete();
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Bạn đã đăng xuất thành công!',
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền thực hiện chức năng này!',
            ]);
        }
    }

    public function dangXuatAll()
    {
        $user     = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\NhanVien) {

            $ds_token = $user->tokens;

            foreach ($ds_token as $key => $value) {
                $value->delete();
            }

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Bạn đã đăng xuất tất cả thành công!',
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền thực hiện chức năng này!',
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
     public function getDataOpen()
    {
        $id_chuc_nang = 2;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = NhanVien::where('is_block', 0)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
