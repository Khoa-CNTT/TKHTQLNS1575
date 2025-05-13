<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiVangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loai_vangs')->delete();
        DB::table('loai_vangs')->truncate();
        DB::table('loai_vangs')->insert([
            [
                'id' => 1,
                'ten_loai_vang' => 'Báo cáo vắng đi công tác',
                'diem_duoc_cham' => 0,
                'tinh_trang' => 1,
            ],
            [
                'id' => 2,
                'ten_loai_vang' => 'Yêu Cầu Nghĩ Phép',
                'diem_duoc_cham' => 5,
                'tinh_trang' => 1,
            ],

        ]);
    }
}
