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
}
