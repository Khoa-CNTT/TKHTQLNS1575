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
                'ten_loai_vang' => 'Nghỉ phép có lương',
                'diem_duoc_cham' => 0,
                'tinh_trang' => 1,
            ],
            [
                'ten_loai_vang' => 'Nghỉ phép không lương',
                'diem_duoc_cham' => 5,
                'tinh_trang' => 1,
            ],
            [
                'ten_loai_vang' => 'Nghỉ ốm',
                'diem_duoc_cham' => 0,
                'tinh_trang' => 1,
            ],
            [
                'ten_loai_vang' => 'Nghỉ thai sản',
                'diem_duoc_cham' => 0,
                'tinh_trang' => 1,
            ],
            [
                'ten_loai_vang' => 'Đi muộn',
                'diem_duoc_cham' => 2,
                'tinh_trang' => 0,
            ],
            [
                'ten_loai_vang' => 'Về sớm',
                'diem_duoc_cham' => 2,
                'tinh_trang' => 0,
            ],
            [
                'ten_loai_vang' => 'Vắng không phép',
                'diem_duoc_cham' => 10,
                'tinh_trang' => 0,
            ],
        ]);
    }
}
