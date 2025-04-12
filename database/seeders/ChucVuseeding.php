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
                'ten_chuc_vu'        => 'Giám Đốc',
                'tinh_trang'          => 1,
            ],
            [
                'ten_chuc_vu'        => 'Phó Giám đốc',
                'tinh_trang'          => 1,
            ],
            [
                'ten_chuc_vu'        => 'Trường Phòng',
                'tinh_trang'          => 1,
            ],
            [
                'ten_chuc_vu'        => 'Nhân Viên',
                'tinh_trang'          => 0,
            ],
        ]);
    }
}
