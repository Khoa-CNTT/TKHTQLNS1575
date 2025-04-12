<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhongBanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phong_bans')->delete();
        DB::table('phong_bans')->truncate();
        DB::table('phong_bans')->insert([
            [
                'ten_phong_ban'         => "Ban Giám Đốc",
                'id_phong_ban_cha'      => 0,
                'id_truong_phong'       => 1,
                'tinh_trang'            => 1,
            ],
            [
                'ten_phong_ban'         => "Ban Maketing",
                'id_phong_ban_cha'      => 1,
                'id_truong_phong'       => 3,
                'tinh_trang'            => 1,
            ],
            [
                'ten_phong_ban'         => "Ban Tài Chính",
                'id_phong_ban_cha'      => 1,
                'id_truong_phong'       => 4,
                'tinh_trang'            => 1,
            ],
            [
                'ten_phong_ban'         => "Ban Developer",
                'id_phong_ban_cha'      => 1,
                'id_truong_phong'       => 5,
                'tinh_trang'            => 0,
            ],
        ]);
    }
}
