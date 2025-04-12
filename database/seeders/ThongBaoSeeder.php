<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongBaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thong_baos')->delete();
        DB::table('thong_baos')->insert([
            [
                'id'                =>   1,
                'tieu_de'           =>   'Đăng nhập',
                'noi_dung'          =>   'Lúc 18h00 ngày 06/11/2024',
                'icon_thong_bao'    =>   'bx bx-group',
                'color_thong_bao'   =>   'text-primary',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   2,
                'tieu_de'           =>   'Đăng xuất',
                'noi_dung'          =>   'Lúc 19h00 ngày 06/11/2024',
                'icon_thong_bao'    =>   'bx bx-cart-alt',
                'color_thong_bao'   =>   'text-danger',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   3,
                'tieu_de'           =>   'Đổi tình trạng nhân viên',
                'noi_dung'          =>   'Đổi nhân viên nguyễn văn A',
                'icon_thong_bao'    =>   'bx bx-send',
                'color_thong_bao'   =>   'text-warning',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   4,
                'tieu_de'           =>   'Demo 01',
                'noi_dung'          =>   'Nội dung demo 01',
                'icon_thong_bao'    =>   'bx bx-home-circle',
                'color_thong_bao'   =>   'text-success',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   5,
                'tieu_de'           =>   'Demo 02',
                'noi_dung'          =>   'Nội dung demo 01',
                'icon_thong_bao'    =>   'bx bx-home-circle',
                'color_thong_bao'   =>   'text-info',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   6,
                'tieu_de'           =>   'Demo 03',
                'noi_dung'          =>   'Nội dung demo 01',
                'icon_thong_bao'    =>   'bx bx-home-circle',
                'color_thong_bao'   =>   'text-success',
                'id_nhan_vien'      =>   2
            ],
            [
                'id'                =>   7,
                'tieu_de'           =>   'Demo 04',
                'noi_dung'          =>   'Nội dung demo 01',
                'icon_thong_bao'    =>   'bx bx-home-circle',
                'color_thong_bao'   =>   'text-primary',
                'id_nhan_vien'      =>   1
            ],
            [
                'id'                =>   8,
                'tieu_de'           =>   'Demo 05',
                'noi_dung'          =>   'Nội dung demo 01',
                'icon_thong_bao'    =>   'bx bx-home-circle',
                'color_thong_bao'   =>   'text-success',
                'id_nhan_vien'      =>   2
            ],
        ]);
    }
}
