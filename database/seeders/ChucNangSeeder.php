<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();
        DB::table('chuc_nangs')->truncate();
        DB::table('chuc_nangs')->insert([
            ['id' => 1, 'ten_chuc_nang'  => 'Xem thông tin nhân viên'],
            ['id' => 2, 'ten_chuc_nang'  => 'Xem thông tin nhân viên còn hoạt động'],
            ['id' => 3, 'ten_chuc_nang'  => 'Tìm kiếm nhân viên'],
            ['id' => 4, 'ten_chuc_nang'  => 'Thêm mới nhân viên'],
            ['id' => 5, 'ten_chuc_nang'  => 'Đổi trạng thái hoạt động của nhân viên'],
            ['id' => 6, 'ten_chuc_nang'  => 'Cập nhật thông tin nhân viên nhân viên'],
            ['id' => 7, 'ten_chuc_nang'  => 'Xóa nhân viên'],
            ['id' => 8, 'ten_chuc_nang'  => 'Xuất file excel danh sách nhân viên'],
            ['id' => 9, 'ten_chuc_nang'  => 'Tính lương nhân viên'],
            ['id' => 10, 'ten_chuc_nang' => 'Xuất file excel lương nhân viên'],
            ['id' => 11, 'ten_chuc_nang' => 'Xem danh sách chức vụ'],
            ['id' => 12, 'ten_chuc_nang' => 'Xem danh sách chức vụ còn hoạt động'],
            ['id' => 13, 'ten_chuc_nang' => 'Thêm mới chức vụ'],
            ['id' => 14, 'ten_chuc_nang' => 'Đổi trạng thái chức vụ'],
            ['id' => 15, 'ten_chuc_nang' => 'Cập nhật chức vụ'],
            ['id' => 16, 'ten_chuc_nang' => 'Xóa chức vụ'],
            ['id' => 17, 'ten_chuc_nang' => 'Xuất file excel danh sách chức vụ'],
            ['id' => 18, 'ten_chuc_nang' => 'Xem danh sách phòng ban'],
            ['id' => 19, 'ten_chuc_nang' => 'Xem danh sách phòng ban còn hoạt động'],
            ['id' => 20, 'ten_chuc_nang' => 'Thêm mới phòng ban'],
            ['id' => 21, 'ten_chuc_nang' => 'Đổi trạng thái phòng ban'],
            ['id' => 22, 'ten_chuc_nang' => 'Cập nhật phòng ban'],
            ['id' => 23, 'ten_chuc_nang' => 'Xóa phòng ban'],
            ['id' => 24, 'ten_chuc_nang' => 'Xuất file excel phòng ban'],
            ['id' => 25, 'ten_chuc_nang' => 'Xem danh sách tiêu chí KPI'],
            ['id' => 26, 'ten_chuc_nang' => 'Xem danh sách tiêu chí KPI còn hoạt động'],
            ['id' => 27, 'ten_chuc_nang' => 'Thêm mới tiêu chí KPI'],
            ['id' => 28, 'ten_chuc_nang' => 'Đổi trạng thái tiêu chí KPI'],
            ['id' => 29, 'ten_chuc_nang' => 'Cập nhật tiêu chí KPI'],
            ['id' => 30, 'ten_chuc_nang' => 'Xóa tiêu chí KPI'],
            ['id' => 31, 'ten_chuc_nang' => 'Xuất file excel danh sách tiêu chí KPI'],
            ['id' => 32, 'ten_chuc_nang' => 'Xem danh sách quy định cho điểm'],
            ['id' => 33, 'ten_chuc_nang' => 'Xem danh sách quy định cho điểm còn hoạt động'],
            ['id' => 34, 'ten_chuc_nang' => 'Thêm mới quy đinh cho điểm'],
            ['id' => 35, 'ten_chuc_nang' => 'Đổi trạng thái quy định cho điểm'],
            ['id' => 36, 'ten_chuc_nang' => 'Cập nhật quy định cho điểm'],
            ['id' => 37, 'ten_chuc_nang' => 'Xóa quy định cho điểm'],
            ['id' => 38, 'ten_chuc_nang' => 'Xuất file excel danh sách quy điểm cho điểm'],
            ['id' => 39, 'ten_chuc_nang' => 'Xem danh sách loại hợp đồng'],
            ['id' => 40, 'ten_chuc_nang' => 'Xem danh sách loại hợp đồng còn hoạt động'],
            ['id' => 41, 'ten_chuc_nang' => 'Thêm mới loại hợp đồng'],
            ['id' => 42, 'ten_chuc_nang' => 'Đổi trạng thái loại hợp đồng'],
            ['id' => 43, 'ten_chuc_nang' => 'Cập nhật loại hợp đồng'],
            ['id' => 44, 'ten_chuc_nang' => 'Xóa loại hợp đồng'],
            ['id' => 45, 'ten_chuc_nang' => 'Xuất file excel loại hợp đồng'],
            ['id' => 46, 'ten_chuc_nang' => 'Xem danh sách chi tiết hợp đồng'],
            ['id' => 47, 'ten_chuc_nang' => 'Nhân viên tạo hợp đồng'],
            ['id' => 48, 'ten_chuc_nang' => 'Xuất file excel chi tiết hợp đồng'],
            ['id' => 49, 'ten_chuc_nang' => 'Xem danh sách KPI nhân viên'],
            ['id' => 50, 'ten_chuc_nang' => 'Thêm mới KPI nhân viên'],
            ['id' => 51, 'ten_chuc_nang' => 'Chấm điểm KPI nhân viên'],
            ['id' => 52, 'ten_chuc_nang' => 'Cập nhật KPI nhân viên'],
            ['id' => 53, 'ten_chuc_nang' => 'Xóa KPI nhân viên'],
            ['id' => 54, 'ten_chuc_nang' => 'Tìm kiếm nhân viên'],
            ['id' => 55, 'ten_chuc_nang' => 'Xuất file excel KPI nhân viên'],
            ['id' => 56, 'ten_chuc_nang' => 'Xem danh sách chấm công'],
            ['id' => 57, 'ten_chuc_nang' => 'Thêm mới chấm công'],
            ['id' => 58, 'ten_chuc_nang' => 'Xóa chấm công'],
            ['id' => 59, 'ten_chuc_nang' => 'Cập nhật chấm công'],
            ['id' => 60, 'ten_chuc_nang' => 'Xuất file excel chấm công'],
            ['id' => 61, 'ten_chuc_nang' => 'Xem danh sách thưởng và phạt'],
            ['id' => 62, 'ten_chuc_nang' => 'Thêm mới thưởng và phạt'],
            ['id' => 63, 'ten_chuc_nang' => 'Cập nhật thưởng và phạt'],
            ['id' => 64, 'ten_chuc_nang' => 'Xóa thưởng và phạt'],
            ['id' => 65, 'ten_chuc_nang' => 'Tìm kiếm thưởng và phạt'],
            ['id' => 66, 'ten_chuc_nang' => 'Xuất file excel thưởng và phạt'],
            ['id' => 67, 'ten_chuc_nang' => 'Thống kê chấm công'],
            ['id' => 68, 'ten_chuc_nang' => 'Thống kê KPI nhân viên'],
            ['id' => 69, 'ten_chuc_nang' => 'Thống kê điểm phạt'],
            ['id' => 70, 'ten_chuc_nang' => 'Thống kê điểm thưởng'],
            ['id' => 71, 'ten_chuc_nang' => 'Xem danh sách quyền'],
            ['id' => 72, 'ten_chuc_nang' => 'Phân quyền cho nhân viên'],
            ['id' => 73, 'ten_chuc_nang' => 'Thu hồi quyền đã phân'],
            ['id' => 74, 'ten_chuc_nang' => 'Tính lương theo tháng'],
            ['id' => 75, 'ten_chuc_nang' => 'Xuất file excel lương theo tháng'],
            ['id' => 76, 'ten_chuc_nang' => 'Xem danh sách nghỉ phép'],
            ['id' => 77, 'ten_chuc_nang' => 'Tạo mới nghỉ phép'],
            ['id' => 78, 'ten_chuc_nang' => 'Cập nhật nghỉ phép'],
            ['id' => 79, 'ten_chuc_nang' => 'Xóa nghỉ phép'],
            ['id' => 80, 'ten_chuc_nang' => 'Xác nhận nghỉ phép'],
            // ['id' => 81, 'ten_chuc_nang' => 'Thêm mới nghĩ phép/báo cáo vắng đi công tác'],
            // ['id' => 82, 'ten_chuc_nang' => 'Xem danh sách nghĩ phép'],
            // ['id' => 83, 'ten_chuc_nang' => 'Sửa nghĩ phép'],
            // ['id' => 84, 'ten_chuc_nang' => 'Xóa nghĩ phép'],
            //['id' => 80, 'ten_chuc_nang' => 'Xuất file excel nghỉ phép'],
        ]);
    }
}
