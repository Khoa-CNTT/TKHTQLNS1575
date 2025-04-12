<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThuongVaPhatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thuong_va_phats')->delete();
        DB::table('thuong_va_phats')->truncate();
        DB::table('thuong_va_phats')->insert([
            [
                'id_nhan_vien'          => 2,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 1,
                'diem'                  => 10,
                'ly_do'                 => 'Thưởng cho hoàn thành công việc đúng hạn',
                'ngay'                  => '2024-09-10',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 2,
                'diem'                  => 5,
                'ly_do'                 => 'Phạt vì đi muộn',
                'ngay'                  => '2024-09-11',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 3,
                'diem'                  => 20,
                'ly_do'                 => 'Thưởng vì đóng góp sáng kiến',
                'ngay'                  => '2024-09-12',
            ],
            [
                'id_nhan_vien'          => 5,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 4,
                'diem'                  => 10,
                'ly_do'                 => 'Phạt vì vi phạm nội quy công ty',
                'ngay'                  => '2024-09-13',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 5,
                'diem'                  => 15,
                'ly_do'                 => 'Thưởng vì làm việc ngoài giờ',
                'ngay'                  => '2024-09-14',
            ],

            [
                'id_nhan_vien'          => 2,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 1,
                'diem'                  => 10,
                'ly_do'                 => 'Thưởng cho hoàn thành công việc xuất sắc',
                'ngay'                  => '2024-10-01',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 2,
                'diem'                  => 5,
                'ly_do'                 => 'Phạt vì đi muộn 20 phút',
                'ngay'                  => '2024-10-02',
            ],
            [
                'id_nhan_vien'          => 5,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 4,
                'diem'                  => 10,
                'ly_do'                 => 'Phạt vì vi phạm quy định an toàn lao động',
                'ngay'                  => '2024-10-03',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 3,
                'diem'                  => 20,
                'ly_do'                 => 'Thưởng vì đóng góp ý tưởng cải tiến quy trình',
                'ngay'                  => '2024-10-05',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 5,
                'diem'                  => 15,
                'ly_do'                 => 'Thưởng vì hoàn thành dự án trước thời hạn',
                'ngay'                  => '2024-10-06',
            ],
            [
                'id_nhan_vien'          => 2,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 1,
                'diem'                  => 10,
                'ly_do'                 => 'Thưởng cho hoàn thành công việc đúng hạn',
                'ngay'                  => '2024-10-08',
            ],
            [
                'id_nhan_vien'          => 5,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 2,
                'diem'                  => 5,
                'ly_do'                 => 'Phạt vì đi muộn 15 phút',
                'ngay'                  => '2024-10-09',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 5,
                'diem'                  => 15,
                'ly_do'                 => 'Thưởng vì làm việc ngoài giờ trong dự án đặc biệt',
                'ngay'                  => '2024-10-10',
            ],

            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 1,
                'diem'                  => 10,
                'ly_do'                 => 'Thưởng cho hoàn thành báo cáo nhanh chóng',
                'ngay'                  => '2024-10-07',
            ],
            [
                'id_nhan_vien'          => 5,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 2,
                'diem'                  => 5,
                'ly_do'                 => 'Phạt vì đi muộn không xin phép',
                'ngay'                  => '2024-10-05',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 3,
                'diem'                  => 20,
                'ly_do'                 => 'Thưởng vì đưa ra giải pháp tiết kiệm chi phí',
                'ngay'                  => '2024-10-06',
            ],
            [
                'id_nhan_vien'          => 2,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 4,
                'diem'                  => 10,
                'ly_do'                 => 'Phạt vì không tuân thủ quy trình an toàn',
                'ngay'                  => '2024-10-04',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 5,
                'diem'                  => 15,
                'ly_do'                 => 'Thưởng vì làm thêm giờ để hoàn thành kế hoạch',
                'ngay'                  => '2024-10-08',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 1,
                'diem'                  => 10,
                'ly_do'                 => 'Thưởng vì đạt được mục tiêu công việc trước thời hạn',
                'ngay'                  => '2024-10-09',
            ],
            [
                'id_nhan_vien'          => 5,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 2,
                'diem'                  => 5,
                'ly_do'                 => 'Phạt vì làm việc trễ mà không có lý do',
                'ngay'                  => '2024-10-07',
            ],
            [
                'id_nhan_vien'          => 2,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 3,
                'diem'                  => 20,
                'ly_do'                 => 'Thưởng vì sáng kiến giúp nâng cao hiệu suất làm việc',
                'ngay'                  => '2024-10-06',
            ],
            [
                'id_nhan_vien'          => 3,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 4,
                'diem'                  => 10,
                'ly_do'                 => 'Phạt vì vi phạm quy định làm việc nhóm',
                'ngay'                  => '2024-10-04',
            ],
            [
                'id_nhan_vien'          => 4,
                'id_nhan_vien_cho_diem' => 1,
                'id_quy_dinh'           => 5,
                'diem'                  => 15,
                'ly_do'                 => 'Thưởng vì hoàn thành công việc gấp trước thời hạn',
                'ngay'                  => '2024-10-10',
            ],            

        ]);
    }
}
