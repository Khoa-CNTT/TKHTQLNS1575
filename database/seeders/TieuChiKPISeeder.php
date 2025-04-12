<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TieuChiKPISeeder extends Seeder
{

    public function run(): void
    {
        DB::table('tieu_chi_kpis')->delete();
        DB::table('tieu_chi_kpis')->truncate();
        DB::table('tieu_chi_kpis')->insert([
            [
                'id'                => 1,
                'ten_tieu_chi'      => 'Hoàn thành dự án',
                'mo_ta'             => 'Đã hoàn thành dự án được giao trước thời gian quy định',
                'diem'              => 50,
                'tinh_trang'        => 1
            ],
            [
                'id'                => 2,
                'ten_tieu_chi'      => 'Hoàn thành tài liệu dự án',
                'mo_ta'             => 'Đã hoàn thành tài liệu dự án được giao trước thời gian quy định',
                'diem'              => 50,
                'tinh_trang'        => 1
            ],
            [
                'id'                => 3,
                'ten_tieu_chi'      => 'Báo cáo tiến độ đúng hạn',
                'mo_ta'             => 'Tỷ lệ báo cáo tiến độ dự án được gửi đúng hạn và đầy đủ thông tin.',
                'diem'              => 40,
                'tinh_trang'        => 1
            ],
            [
                'id'                => 4,
                'ten_tieu_chi'      => 'Đóng góp ý tưởng cho dự án',
                'mo_ta'             => 'Góp ý những giải pháp mới được đề xuất trong quá trình làm dự án.(phải được áp dụng mới tính vào KPI)',
                'diem'              => 40,
                'tinh_trang'        => 1
            ],
            [
                'id'                => 5,
                'ten_tieu_chi'      => 'Đánh giá kỹ năng lãnh đạo',
                'mo_ta'             => 'Đánh giá bao gồm khả năng đưa ra quyết định, phân công công việc hợp lý, truyền đạt mục tiêu rõ ràng, động viên và khuyến khích sự hợp tác trong nhóm... (do cấp trên chấm)',
                'diem'              => 30,
                'tinh_trang'        => 1
            ],
            [
                'id'                => 6,
                'ten_tieu_chi'      => 'Tham gia vào các khóa đào tạo',
                'mo_ta'             => 'Mức độ tham gia vào các khóa đào tạo để nâng cao kỹ năng.(do cấp trên chấm)',
                'diem'              => 20,
                'tinh_trang'        => 1
            ]
        ]);
    }
}
