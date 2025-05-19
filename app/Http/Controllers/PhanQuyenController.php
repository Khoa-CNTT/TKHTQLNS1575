<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetQuyenRequest;
use App\Models\ChucNang;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;

class PhanQuyenController extends Controller
{
    public function getListChucNang(Request $request)
    {
        $id_chuc_nang = 71;
     $user_login = $this->checkPhanQuyen($id_chuc_nang);

        $data = ChucNang::get();

        $phanQuyen = PhanQuyen::select('id', 'id_chuc_nang')->where('id_chuc_vu', $request->id)->get();

        foreach ($data as $k => $v) {
            $v->is_phan_quyen = 0;
            $v->id_phan_quyen = 0;
            foreach ($phanQuyen as $key => $value) {
                if ($v->id == $value->id_chuc_nang) {
                    $v->is_phan_quyen = 1;
                    $v->id_phan_quyen = $value->id;
                }
            }
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function setQuyen(Request $request)
    {
        // return response()->json($request->all());
        $id_chuc_nang = 72;
        $user_login = $this->checkPhanQuyen($id_chuc_nang);
        PhanQuyen::FirstOrCreate([
            'id_chuc_vu'  =>  $request->id_nhan_vien,
            'id_chuc_nang'  =>  $request->id,
        ]);
        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Tạo quyền',
            'noi_dung'          => 'Quyền vừa được tạo',
            'icon_thong_bao'    => 'fa-regular fa-building',
            'color_thong_bao'   => 'text-danger',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status'    =>  1,
            'message'   =>  'Đã phân quyền thành công!'
        ]);
    }

    public function delQuyen(Request $request)
    {
        $id_chuc_nang = 73;
$user_login = $this->checkPhanQuyen($id_chuc_nang);
        PhanQuyen::where('id', $request->id_phan_quyen)->delete();

        // Lưu log
        ThongBao::create([
            'tieu_de'           => 'Xóa quyền',
            'noi_dung'          => 'Quyền vừa được xóa',
            'icon_thong_bao'    => 'fa-solid fa-shield-halved',
            'color_thong_bao'   => 'text-warning',
            'id_nhan_vien'      => $user_login->id,
        ]);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã hủy quyền này thành công!'
        ]);
    }
}
