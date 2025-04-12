<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KpiNhanVienSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kpi_nhan_viens')->insert([
            [
                'id_nhan_vien' => 1,
                'id_tieu_chi' => 1,
                'diem_duoc_cham' => 40,
                'id_nhan_vien_danh_gia' => 3,
                'ngay_danh_gia' => Carbon::now()->subDays(3),
            ],
            [
                'id_nhan_vien' => 2,
                'id_tieu_chi' => 2,
                'diem_duoc_cham' => 40,
                'id_nhan_vien_danh_gia' => 4,
                'ngay_danh_gia' => Carbon::now()->subDays(7),
            ],
            [
                'id_nhan_vien' => 3,
                'id_tieu_chi' => 3,
                'diem_duoc_cham' => 28,
                'id_nhan_vien_danh_gia' => 1,
                'ngay_danh_gia' => Carbon::now()->subDays(10),
            ],
            [
                'id_nhan_vien' => 4,
                'id_tieu_chi' => 4,
                'diem_duoc_cham' => 20,
                'id_nhan_vien_danh_gia' => 2,
                'ngay_danh_gia' => Carbon::now()->subDays(5),
            ],
            [
                'id_nhan_vien' => 1,
                'id_tieu_chi' => 5,
                'diem_duoc_cham' => 15,
                'id_nhan_vien_danh_gia' => 4,
                'ngay_danh_gia' => Carbon::now()->subDays(12),
            ],
            [
                'id_nhan_vien' => 2,
                'id_tieu_chi' => 6,
                'diem_duoc_cham' => 19,
                'id_nhan_vien_danh_gia' => 3,
                'ngay_danh_gia' => Carbon::now()->subDays(8),
            ],
            [
                'id_nhan_vien' => 3,
                'id_tieu_chi' => 2,
                'diem_duoc_cham' => 38,
                'id_nhan_vien_danh_gia' => 2,
                'ngay_danh_gia' => Carbon::now()->subDays(9),
            ],
            [
                'id_nhan_vien' => 4,
                'id_tieu_chi' => 1,
                'diem_duoc_cham' => 29,
                'id_nhan_vien_danh_gia' => 1,
                'ngay_danh_gia' => Carbon::now()->subDays(6),
            ],
            [
                'id_nhan_vien' => 1,
                'id_tieu_chi' => 3,
                'diem_duoc_cham' => 34,
                'id_nhan_vien_danh_gia' => 4,
                'ngay_danh_gia' => Carbon::now()->subDays(11),
            ],
            [
                'id_nhan_vien' => 2,
                'id_tieu_chi' => 5,
                'diem_duoc_cham' => 16,
                'id_nhan_vien_danh_gia' => 3,
                'ngay_danh_gia' => Carbon::now()->subDays(4),
            ],
        ]);
    }
}
