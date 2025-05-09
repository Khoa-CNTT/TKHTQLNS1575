<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucVuseeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_vus')->delete();
        DB::table('chuc_vus')->truncate();
        DB::table('chuc_vus')->insert([
            [
                'id'                    => 1,
                'ten_chuc_vu'           => 'Giám Đốc',
                'tinh_trang'            => 1,
                'id_chuc_vu_cha'        => null,
            ],
            [
                'id'                    => 2,
                'ten_chuc_vu'           => 'Phó Giám đốc',
                'tinh_trang'            => 1,
                'id_chuc_vu_cha'        => 1,
            ],
            [
                'id'                    => 3,
                'ten_chuc_vu'           => 'Trường Phòng Tài Chính',
                'tinh_trang'            => 1,
                'id_chuc_vu_cha'        => 2,
            ],
            [
                'id'                    => 4,
                'ten_chuc_vu'           => 'Nhân Viên',
                'tinh_trang'            => 0,
                'id_chuc_vu_cha'        => 3,
            ],
            [
                'id'                    => 5,
                'ten_chuc_vu'           => 'Leader Nhóm',
                'tinh_trang'            => 0,
                'id_chuc_vu_cha'        => 3,
            ],
            [
                'id'                    => 6,
                'ten_chuc_vu'           => 'Trường Phòng Marketing',
                'tinh_trang'            => 1,
                'id_chuc_vu_cha'        => 2,
            ],
        ]);
    }
}
