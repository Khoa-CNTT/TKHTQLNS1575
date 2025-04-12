<?php

namespace App\Http\Controllers;

use App\Exports\ExcelQuyDinhChoDiemExport;
use App\Http\Requests\QDCDChangeStatusRequest;
use App\Http\Requests\QDCDCreateRequest;
use App\Http\Requests\QDCDDeleteRequest;
use App\Http\Requests\QDCDUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\QuyDinhChoDiem;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class QuyDinhChoDiemController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 32;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = QuyDinhChoDiem::get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function getDataOpen()
    {
        $id_chuc_nang = 33;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = QuyDinhChoDiem::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(QDCDCreateRequest $request)
    {
        $id_chuc_nang = 34;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        QuyDinhChoDiem::create([
            'ma_so'         => $request->ma_so,
            'noi_dung'      => $request->noi_dung,
            'so_diem'       => $request->so_diem,
            'loai_diem'     => $request->loai_diem,
            'tinh_trang'    => $request->tinh_trang,
            'ghi_chu'       => $request->ghi_chu,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo quy đinh cho điểm',
            'noi_dung'          => 'Quy đinh cho điểm ' . $request->ma_so . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới quy định cho điểm ' . $request->ma_so . ' thành công.',
        ]);
    }
    public function updateQuyDinhChoDiem(QDCDUpdateRequest $request)
    {
        $id_chuc_nang = 36;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        QuyDinhChoDiem::where('id', $request->id)->update([
            'ma_so'         => $request->ma_so,
            'noi_dung'      => $request->noi_dung,
            'so_diem'       => $request->so_diem,
            'loai_diem'     => $request->loai_diem,
            'tinh_trang'    => $request->tinh_trang,
            'ghi_chu'       => $request->ghi_chu,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật quy đinh cho điểm',
            'noi_dung'          => 'Quy định cho điểm ' . $request->ma_so . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deleteQuyDinhChoDiem(QDCDDeleteRequest $request)
    {
        $id_chuc_nang = 37;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        QuyDinhChoDiem::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa quy đinh cho điểm',
            'noi_dung'          => 'Quy định cho điểm ' . $request->ma_so . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }
    public function changeStatus(QDCDChangeStatusRequest $request)
    {
        $id_chuc_nang = 35;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $quy_dinh_cho_diem = QuyDinhChoDiem::find($request->id);
        if ($quy_dinh_cho_diem) {
            $quy_dinh_cho_diem->tinh_trang = !$quy_dinh_cho_diem->tinh_trang;
        }
        $quy_dinh_cho_diem->save();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái quy đinh cho điểm',
            'noi_dung'          => 'Quy đinh cho điểm ' . $request->ma_so . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $quy_dinh_cho_diem->ten_tieu_chi . ' thành công ',
        ]);
    }

    public function xuatExcelQuyDinhChoDiem()
    {
        $id_chuc_nang = 38;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = QuyDinhChoDiem::get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu quy định cho điểm',
            'noi_dung'          => 'Quy định cho điểm vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelQuyDinhChoDiemExport($data), 'quy_dinh_cho_diem.xlsx');
    }
}
