<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuyDinhChoDiemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quy_dinh_cho_diems')->delete();

        DB::table('quy_dinh_cho_diems')->truncate();

        DB::table('quy_dinh_cho_diems')->insert([
            [
                'ma_so' => 'QD001',
                'noi_dung' => 'Điểm thưởng cho hoàn thành công việc đúng hạn',
                'so_diem' => 10,
                'loai_diem' => 0,
                'tinh_trang'=> 1,
                'ghi_chu' => 'Áp dụng cho tất cả nhân viên',
            ],
            [
                'ma_so' => 'QD002',
                'noi_dung' => 'Điểm phạt vì đi muộn',
                'so_diem' => 5,
                'loai_diem' => 1,
                'tinh_trang'=> 1,
                'ghi_chu' => 'Áp dụng khi đi muộn hơn 15 phút',
            ],
            [
                'ma_so' => 'QD003',
                'noi_dung' => 'Điểm thưởng vì đóng góp sáng kiến',
                'so_diem' => 20,
                'loai_diem' => 0,
                'tinh_trang'=> 1,
                'ghi_chu' => 'Chỉ áp dụng cho nhân viên được quản lý đánh giá',
            ],
            [
                'ma_so' => 'QD004',
                'noi_dung' => 'Điểm phạt vì vi phạm nội quy công ty',
                'so_diem' => 10,
                'loai_diem' => 1,
                'tinh_trang'=> 1,
                'ghi_chu' => 'Áp dụng cho các trường hợp vi phạm nghiêm trọng',
            ],
            [
                'ma_so' => 'QD005',
                'noi_dung' => 'Điểm thưởng vì làm việc ngoài giờ',
                'so_diem' => 15,
                'loai_diem' => 0,
                'tinh_trang'=> 1,
                'ghi_chu' => 'Áp dụng khi có sự chấp thuận của quản lý',
            ],
        ]);
    }
}
