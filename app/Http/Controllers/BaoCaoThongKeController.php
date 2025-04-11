<?php

namespace App\Http\Controllers;


use App\Models\BaoCaoThongKe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaoCaoThongKeController extends Controller
{
   public function createBaoCao(request $request){
        $nhan_vien = Auth::guard('sanctum')->user();

        if($nhan_vien){
            BaoCaoThongKe::create([
                'id_nhan_vien'  => $nhan_vien ->id,
                'ten_bao_cao'   => $request  ->ten_bao_cao,
                'mo_ta'         => $request  ->mo_ta,
                'loai_bao_cao'  => $request ->loai_bao_cao,
                'ngay_tao'      => $request ->ngay_tao,
                'trang_thai'    => $request->trang_thai
            ]);
            return response()->json([
            'status'    => true,
            'message'   => "Đã thêm báo cáo thành công thành công!"
        ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => "Thêm báo cáo thất bại!"
            ]);
        }
   }
    public function dataBaoCaoThongKeCaNhan()
        {
              $nhan_vien = Auth::guard('sanctum')->user();

            if ($nhan_vien) {
                $data = BaoCaoThongKe::where('id_khach_hang', $nhan_vien->id)->get();
            } else {
                $data = collect();
            }

            return response()->json([
                'data' => $data
            ]);

        }
}
