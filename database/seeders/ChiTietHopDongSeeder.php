<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietHopDongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy nội dung các loại hợp đồng từ bảng `loai_hop_dongs`
    $loaiHopDong1 = DB::table('loai_hop_dongs')->where('id', 1)->value('noi_dung');
    $loaiHopDong2 = DB::table('loai_hop_dongs')->where('id', 2)->value('noi_dung');
    $loaiHopDong3 = DB::table('loai_hop_dongs')->where('id', 3)->value('noi_dung');
    $loaiHopDong4 = DB::table('loai_hop_dongs')->where('id', 4)->value('noi_dung');

    DB::table('chi_tiet_hop_dongs')->delete();
    DB::table('chi_tiet_hop_dongs')->truncate();
    DB::table('chi_tiet_hop_dongs')->insert([
        [
            'id_nhan_vien' => 2,
            'id_loai_hop_dong' => 2,
            'noi_dung' => $loaiHopDong2,
            'ngay_ky' => '2024-02-10',
            'ngay_bat_dau' => '2024-03-01',
            'ngay_ket_thuc' => '2030-01-15',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id_nhan_vien' => 3,
            'id_loai_hop_dong' => 3,
            'noi_dung' => $loaiHopDong3,
            'ngay_ky' => '2024-05-20',
            'ngay_bat_dau' => '2024-06-01',
            'ngay_ket_thuc' => '2024-12-01',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id_nhan_vien' => 4,
            'id_loai_hop_dong' => 4,
            'noi_dung' => $loaiHopDong4,
            'ngay_ky' => '2024-07-10',
            'ngay_bat_dau' => '2024-07-15',
            'ngay_ket_thuc' => '2024-09-15',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id_nhan_vien' => 5,
            'id_loai_hop_dong' => 1,
            'noi_dung' => $loaiHopDong1,
            'ngay_ky' => '2024-08-01',
            'ngay_bat_dau' => '2024-08-15',
            'ngay_ket_thuc' => '2025-08-15',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
