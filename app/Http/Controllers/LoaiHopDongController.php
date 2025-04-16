<?php

namespace App\Http\Controllers;

use App\Exports\ExcelLoaiHopDongExport;
use App\Http\Requests\LoaiHopDongChangeStatusRequest;
use App\Http\Requests\LoaiHopDongCreateRequest;
use App\Http\Requests\LoaiHopDongDeleteRequest;
use App\Http\Requests\LoaiHopDongUpdateRequest;
use App\Models\LoaiHopDong;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LoaiHopDongController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 39;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = LoaiHopDong::get();

        return response()->json([
            'data' => $data
        ]);
    }
public function getDataOpen()
    {
        $id_chuc_nang = 40;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = LoaiHopDong::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(LoaiHopDongCreateRequest $request)
    {
        $id_chuc_nang = 41;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        LoaiHopDong::create([
            'ten_hop_dong'  => $request->ten_hop_dong,
            'noi_dung'      => $request->noi_dung,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo loại hợp dồng',
            'noi_dung'          => 'Loại hợp đồng ' . $request->ten_hop_dong . ' vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo mới loại hợp đồng' . $request->ten_hop_dong . ' thành công.',
        ]);
    }
    public function changeStatus(LoaiHopDongChangeStatusRequest $request)
    {
        $id_chuc_nang = 42;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $loai_hop_dong = LoaiHopDong::find($request->id);
        if ($loai_hop_dong) {
            $loai_hop_dong->tinh_trang = !$loai_hop_dong->tinh_trang;
        }
        $loai_hop_dong->save();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Đổi trạng thái loại hợp đồng',
            'noi_dung'          => 'Loại hợp đồng ' . $request->ten_hop_dong . ' vừa đổi trạng thái',
            'icon_thong_bao'    => 'fa-solid fa-plane-departure',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi tình trạng ' . $loai_hop_dong->ten_hop_dong . ' thành công ',
        ]);
    }
    public function updateLoaiHopDong(LoaiHopDongUpdateRequest $request)
    {
        $id_chuc_nang = 43;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        LoaiHopDong::where('id', $request->id)->update([
            'ten_hop_dong'  => $request->ten_hop_dong,
            'noi_dung'      => $request->noi_dung,
            'tinh_trang'    => $request->tinh_trang,
        ]);

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Cập nhật loại hợp đồng',
            'noi_dung'          => 'Loại hợp đồng ' . $request->ten_hop_dong . ' vừa được cập nhật',
            'icon_thong_bao'    => 'fa-brands fa-discord',
            'color_thong_bao'   => 'text-info',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thành công'
        ]);
    }
    public function deleteLoaiHopDong(LoaiHopDongDeleteRequest $request)
    {
        $id_chuc_nang = 44;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        LoaiHopDong::where('id', $request->id)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa loại hợp đồng',
            'noi_dung'          => 'Loại hợp đồng ' . $request->ten_hop_dong . ' vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }

    public function xuatExcelLoaiHopDong()
    {
        $id_chuc_nang = 45;
        $user_login = Auth::guard('sanctum')->user();
        $check = PhanQuyen::where('id_nhan_vien', $user_login->id)->where('id_chuc_nang', $id_chuc_nang)->first();

        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền sử dụng chức năng này!'
            ]);
        }
        $data = LoaiHopDong::get();

        foreach ($data as $key => $value) {
            $value->stt = $key + 1;
        }

        ThongBao::create([
            'tieu_de'           => 'Xuất dữ liệu loại hợp đồng',
            'noi_dung'          => 'Loại hợp đồng vừa xuất dữ liệu ra khỏi hệ thống',
            'icon_thong_bao'    => 'fa-regular fa-file-excel',
            'color_thong_bao'   => 'text-primary',
            'id_nhan_vien'      => $user_login->id,
        ]);

        return Excel::download(new ExcelLoaiHopDongExport($data), 'loai_hop_dong.xlsx');
    }
}
