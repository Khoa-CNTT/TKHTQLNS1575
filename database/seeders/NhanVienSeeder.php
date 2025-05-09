<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_viens')->delete();
        DB::table('nhan_viens')->truncate();
        DB::table('nhan_viens')->insert([
            [
                'id_phong_ban'   => 1, // Ban Giám Đốc
                'id_chuc_vu'     => 1, // Giám Đốc
                'ho_va_ten'      => 'Nguyễn Văn A',
                'email'          => 'thanhphuocj3@gmail.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1980-01-01',
                'dia_chi'        => '123 Nguyễn Trãi, Hà Nội',
                'so_dien_thoai'  => '0123456789',
                'is_block'       => 0,
                'is_master'      => 1,
                'luong_co_ban'   => 20000000, // Thêm lương cơ bản
            ],
            [
                'id_phong_ban'   => 1, // Ban Giám Đốc
                'id_chuc_vu'     => 2, // Phó Giám Đốc
                'ho_va_ten'      => 'Trần Thị B',
                'email'          => 'tranthib@example.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1985-05-15',
                'dia_chi'        => '456 Lê Lợi, Hồ Chí Minh',
                'so_dien_thoai'  => '0987654321',
                'is_block'       => 0,
                'is_master'      => 0,
                'luong_co_ban'   => 18000000, // Thêm lương cơ bản
            ],
            [
                'id_phong_ban'   => 3, // Ban Maketing
                'id_chuc_vu'     => 3, // Trưởng Phòng
                'ho_va_ten'      => 'Lê Văn E',
                'email'          => 'levane@example.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1990-03-22',
                'dia_chi'        => '123 Hai Bà Trưng, Đà Nẵng',
                'so_dien_thoai'  => '0345612310',
                'is_block'       => 0,
                'is_master'      => 0,
                'luong_co_ban'   => 15000000, // Thêm lương cơ bản
            ],
            [
                'id_phong_ban'   => 3, // Ban Tài Chính
                'id_chuc_vu'     => 6, // Trưởng Phòng
                'ho_va_ten'      => 'Lê Văn C',
                'email'          => 'levanc@example.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1990-03-22',
                'dia_chi'        => '789 Hai Bà Trưng, Đà Nẵng',
                'so_dien_thoai'  => '0345678910',
                'is_block'       => 0,
                'is_master'      => 0,
                'luong_co_ban'   => 15000000, // Thêm lương cơ bản
            ],
            [
                'id_phong_ban'   => 4, // Ban Developer
                'id_chuc_vu'     => 4, // Nhân Viên
                'ho_va_ten'      => 'Phạm Văn D',
                'email'          => 'phamvand@example.com',
                'password'       => bcrypt('123456'),
                'ngay_sinh'      => '1992-08-10',
                'dia_chi'        => '321 Cầu Giấy, Hà Nội',
                'so_dien_thoai'  => '0765432109',
                'is_block'       => 1, // Tài khoản bị khóa
                'is_master'      => 0,
                'luong_co_ban'   => 12000000, // Thêm lương cơ bản
            ],
        ]);
    }
}
