<?php

namespace App\Http\Controllers;

use App\Exports\ExcelChamCongExport;
use App\Http\Requests\ChamCongCreateRequest;
use App\Http\Requests\ChamCongDeleteRequest;
use App\Http\Requests\ChamCongUpdateRequest;
use App\Models\CaLam;
use App\Models\ChamCong;
use App\Models\ConfigIP;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PSpell\Config;

class ChamCongController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 56;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ChamCong::join('nhan_viens', 'cham_congs.id_nhan_vien', 'nhan_viens.id')
            ->join('phong_bans', 'nhan_viens.id_phong_ban', 'phong_bans.id')
            ->select('cham_congs.*', 'nhan_viens.ho_va_ten', 'phong_bans.ten_phong_ban',)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(ChamCongCreateRequest $request)
    {
        $id_chuc_nang = 57;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        ChamCong::create([
            'id_nhan_vien'      => $request->id_nhan_vien,
            'ngay_lam_viec'     => $request->ngay_lam_viec,
            'ca_lam'            => $request->ca_lam,
        ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo chấm công',
            'noi_dung'          => 'Chấm công vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới thành công',
        ]);
    }
    public function updateChamCong(ChamCongUpdateRequest $request)
    {
        $id_chuc_nang = 59;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $cham_cong = ChamCong::where('id', $request->id)->first();
        if (!$cham_cong) {
            return response()->json([
                'status' => false,
                'message' => 'Chấm công không tồn tại',
            ]);
        }
        ChamCong::where('id', $request->id)
            ->update([
                'id_nhan_vien'      => $request->id_nhan_vien,
                'ngay_lam_viec'     => $request->ngay_lam_viec,
                'ca_lam'            => $request->ca_lam,
            ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật chấm công',
            'noi_dung'          => 'Chấm công vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã update thành công',
        ]);
    }
    public function deleteChamCong(ChamCongDeleteRequest $request)
    {
        $id_chuc_nang = 58;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        ChamCong::where('id', $request->id)->delete();
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa chấm công',
            'noi_dung'          => 'Chấm công ' . $request->ten_phong_ban . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function xuatExcelChamCong()
    {
        $id_chuc_nang = 60;
       $user_login = $this->checkPhanQuyen($id_chuc_nang);
        $data = ChamCong::join('nhan_viens', 'cham_congs.id_nhan_vien', 'nhan_viens.id')
            ->join('phong_bans', 'nhan_viens.id_phong_ban', 'phong_bans.id')
            ->select('cham_congs.*', 'nhan_viens.ho_va_ten', 'phong_bans.ten_phong_ban',)
            ->get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu chấm công',
            'noi_dung'          => 'Chấm công vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelChamCongExport($data), 'cham_cong.xlsx');
    }

    public function actionChamCongNtf($id, Request $request)
    {
        $ip = $request->ip();
        $today = Carbon::now()->format('d/m/Y');
        $check_ip = ConfigIP::where('ip_address', $ip)->first();
        $time_now = Carbon::now()->format('H:i:s');
        $time_now_1 = Carbon::now()->addMinutes(30)->format('H:i:s');
        $time_now_2 = Carbon::now()->subMinutes(30)->format('H:i:s');
        if ($ip == "127.0.0.1" || $check_ip) {
            $ca_lam   = CaLam::whereTime('gio_vao', '<=', $time_now_1)
                ->whereTime('gio_ra', '>=', $time_now_2)
                ->first();

            $nhan_vien = NhanVien::where('id', $id)->first();
            if (!$nhan_vien) {
                $status = 3;
                $message = 'Nhân viên ' . $nhan_vien->ho_va_ten . ' không tồn tại';
                return view('cham_cong', compact('status', 'message', 'time_now', 'today', 'ca_lam'));
            }

            $checkChamCong = ChamCong::where('id_nhan_vien', $id)
                ->whereDate('ngay_lam_viec', Carbon::now()->format('Y-m-d'))
                ->where('ca_lam', $ca_lam->id)
                ->get();

            if (count($checkChamCong) >= 2) {
                $status = 2;
                $message = 'Nhân viên ' . $nhan_vien->ho_va_ten . ' đã chấm công ca này rồi';
                return view('cham_cong', compact('status', 'message', 'time_now', 'today', 'ca_lam'));
            } elseif (count($checkChamCong) == 0) { // Vì chưa chấm công vào thì chỗ này bắt buộc là chấm công vào
                $trang_thai = ChamCong::CHAM_CONG_DUNG;
                if ($time_now > $ca_lam->gio_vao) {
                    $trang_thai = ChamCong::CHAM_CONG_SAI_GIO;
                }
                $cham_cong_new = ChamCong::create([
                    'id_nhan_vien'      => $id,
                    'ngay_lam_viec'     => Carbon::now()->format('Y-m-d'),
                    'ca_lam'            => $ca_lam->id,
                    'thoi_gian_cham_cong' => $time_now,
                    'trang_thai'        => $trang_thai,
                    'type'              => ChamCong::CHAM_CONG_VAO,
                ]);
            } else {
                $trang_thai = ChamCong::CHAM_CONG_DUNG;
                if ($time_now < $ca_lam->gio_ra) {
                    $trang_thai = ChamCong::CHAM_CONG_SAI_GIO;
                }
                $cham_cong_new = ChamCong::create([
                    'id_nhan_vien'      => $id,
                    'ngay_lam_viec'     => Carbon::now()->format('Y-m-d'),
                    'ca_lam'            => $ca_lam->id,
                    'thoi_gian_cham_cong' => $time_now,
                    'trang_thai'        => $trang_thai,
                    'type'              => ChamCong::CHAM_CONG_RA,
                ]);
            }
            $status = 0;
            if ($trang_thai == ChamCong::CHAM_CONG_SAI_GIO) {
                $status = 1;
                $message = 'Nhân viên ' . $nhan_vien->ho_va_ten . ' đã chấm công <b style="color: #e74c3c">SAI GIỜ</b>!';
            } else {
                $message = 'Nhân viên ' . $nhan_vien->ho_va_ten . ' đã chấm công <b style="color: #27ae60">THÀNH CÔNG</b>!';
            }
            $vao_ra      = $cham_cong_new->type == ChamCong::CHAM_CONG_VAO ? 'VÀO' : 'RA';
            return view('cham_cong', compact('status', 'message', 'time_now', 'today', 'ca_lam', 'vao_ra'));
        } else {
            $status = 1;
            $message = 'IP không hợp lệ';
            return view('cham_cong', compact('status', 'message', 'time_now', 'today'));
        }
    }
}
