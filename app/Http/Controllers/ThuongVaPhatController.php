<?php

namespace App\Http\Controllers;

use App\Exports\ExcelThuongVaPhatExport;
use App\Http\Requests\ThuongVaPhatCreateRequest;
use App\Http\Requests\ThuongVaPhatDeleteRequest;
use App\Http\Requests\ThuongVaPhatUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\QuyDinhChoDiem;
use App\Models\ThongBao;
use App\Models\ThuongVaPhat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ThuongVaPhatController extends Controller
{
    public function timKiemThuongPhat(Request $request)
    {
        $id_chuc_nang = 65;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ThuongVaPhat::join('nhan_viens', 'thuong_va_phats.id_nhan_vien', 'nhan_viens.id')
            ->join('nhan_viens as nv', 'thuong_va_phats.id_nhan_vien_cho_diem', 'nv.id')
            ->join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id',)
            ->select(
                'thuong_va_phats.*',
                'nhan_viens.ho_va_ten',
                'quy_dinh_cho_diems.noi_dung',
                'nv.ho_va_ten as ten_nhan_vien_cho_diem',
            )
            ->where('nhan_viens.ho_va_ten', 'like', '%' . $request->noi_dung . '%')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function deleteThuongPhat(ThuongVaPhatDeleteRequest $request)
    {
        $id_chuc_nang = 64;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        ThuongVaPhat::where('id', $request->id)->delete();
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa thưởng và phạt',
            'noi_dung'          => 'Thưởng và phạt vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function updateThuongPhat(ThuongVaPhatUpdateRequest $request)
    {
        $id_chuc_nang = 63;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $quyDinh = QuyDinhChoDiem::where('id', $request->id_quy_dinh)->first();
        ThuongVaPhat::where('id', $request->id)->update([
            'id_nhan_vien'          => $request->id_nhan_vien,
            'id_nhan_vien_cho_diem' => 1,
            'id_quy_dinh'           => $quyDinh->id,
            'diem'                  => $quyDinh->so_diem,
            'ly_do'                 => $request->ly_do,
            'ngay'                  => Carbon::now()
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật thưởng và phạt',
            'noi_dung'          => 'Thưởng và phạt vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật thành công'
        ]);
    }
    public function store(ThuongVaPhatCreateRequest $request)
    {
        $id_chuc_nang = 62;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $quyDinh = QuyDinhChoDiem::where('id', $request->id_quy_dinh)->first();

        ThuongVaPhat::create([
            'id_nhan_vien'          => $request->id_nhan_vien,
            'id_nhan_vien_cho_diem' => 1,
            'id_quy_dinh'           => $quyDinh->id,
            'diem'                  => $quyDinh->so_diem,
            'ly_do'                 => $request->ly_do,
            'ngay'                  => Carbon::now()
        ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo thưởng và phạt',
            'noi_dung'          => 'Thưởng và phạt vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới thành công'
        ]);
    }
    public function getData()
    {
        $id_chuc_nang = 61;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ThuongVaPhat::join('nhan_viens', 'thuong_va_phats.id_nhan_vien', 'nhan_viens.id')
            ->join('nhan_viens as nv', 'thuong_va_phats.id_nhan_vien_cho_diem', 'nv.id')
            ->join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id',)
            ->select(
                'thuong_va_phats.*',
                'nhan_viens.ho_va_ten',
                'quy_dinh_cho_diems.noi_dung',
                'nv.ho_va_ten as ten_nhan_vien_cho_diem',
            )
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

     public function xuatExcelThuongVaPhat()
    {
        $id_chuc_nang = 66;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = ThuongVaPhat::join('nhan_viens', 'thuong_va_phats.id_nhan_vien', 'nhan_viens.id')
            ->join('nhan_viens as nv', 'thuong_va_phats.id_nhan_vien_cho_diem', 'nv.id')
            ->join('quy_dinh_cho_diems', 'thuong_va_phats.id_quy_dinh', 'quy_dinh_cho_diems.id',)
            ->select(
                'thuong_va_phats.*',
                'nhan_viens.ho_va_ten',
                'quy_dinh_cho_diems.noi_dung',
                'nv.ho_va_ten as ten_nhan_vien_cho_diem',
            )
            ->get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu thưởng và phạt',
            'noi_dung'          => 'Thưởng và phạt vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelThuongVaPhatExport($data), 'thuong_va_phat.xlsx');
    }

}
