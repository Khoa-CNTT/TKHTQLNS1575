<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaLamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ca_lams')->delete();
        DB::table('ca_lams')->truncate();
        DB::table('ca_lams')->insert([
            [
                'ten_ca' => 'Ca Sáng',
                'gio_vao' => '08:00:00',
                'gio_ra' => '17:00:00',
                'trang_thai' => 1,
            ],
            [
                'ten_ca' => 'Ca Chiều',
                'gio_vao' => '17:00:00',
                'gio_ra' => '22:00:00',
                'trang_thai' => 1,
            ],
            [
                'ten_ca' => 'Ca Đêm',
                'gio_vao' => '22:00:00',
                'gio_ra' => '07:00:00',
                'trang_thai' => 1,
            ],
        ]);
    }
}
