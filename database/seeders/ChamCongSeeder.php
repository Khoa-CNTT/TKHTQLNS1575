<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChamCongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cham_congs')->delete();
        DB::table('cham_congs')->truncate();
        DB::table('cham_congs')->insert([
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-08',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-07',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-06',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-08',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-07',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-06',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-08',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-07',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-06',
                'ca_lam'            =>  3,
            ],

            //
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-13',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-14',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-10',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-13',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-11',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-12',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  4,
                'ngay_lam_viec'     =>  '2024-09-10',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-13',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-11',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-12',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  4,
                'ngay_lam_viec'     =>  '2024-09-10',
                'ca_lam'            =>  3,
            ],

            //
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-15',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-14',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-16',
                'ca_lam'            =>  1,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-15',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-14',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-16',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  4,
                'ngay_lam_viec'     =>  '2024-09-16',
                'ca_lam'            =>  2,
            ],
            [
                'id_nhan_vien'      =>  1,
                'ngay_lam_viec'     =>  '2024-09-15',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  2,
                'ngay_lam_viec'     =>  '2024-09-14',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  3,
                'ngay_lam_viec'     =>  '2024-09-16',
                'ca_lam'            =>  3,
            ],
            [
                'id_nhan_vien'      =>  4,
                'ngay_lam_viec'     =>  '2024-09-16',
                'ca_lam'            =>  3,
            ],


        ]);
    }
}
