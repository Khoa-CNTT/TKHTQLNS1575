<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiHopDongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loai_hop_dongs')->delete();
        DB::table('loai_hop_dongs')->truncate();
        DB::table('loai_hop_dongs')->insert([
            [
                'ten_hop_dong' => 'Hợp Đồng Lao Động Xác Định Thời Hạn',
                'noi_dung' => '<div style="text-align: center;">
                    <p><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
                    <p><strong>Độc lập - Tự do - Hạnh phúc</strong></p>
                    <p>-------oOo-------</p>
                    <p><strong>HỢP ĐỒNG LAO ĐỘNG XÁC ĐỊNH THỜI HẠN</strong></p>
                    <p>Số: ....../HĐLĐ/20....</p>
                </div>

                <p>Chúng tôi, một bên là Ông/Bà: <span style="text-decoration: underline;">..........................................</span> Quốc tịch: Việt Nam</p>
                <p>Chức vụ: <strong>GIÁM ĐỐC</strong></p>
                <p>Đại diện cho (1) CÔNG TY: <span style="text-decoration: underline;">...........................................</span></p>
                <p>Địa chỉ: <span style="text-decoration: underline;">...............................................................</span></p>
                <p>Và một bên là Ông/Bà: <span style="text-decoration: underline;">.................................................</span> Quốc tịch: Việt Nam</p>
                <p>Sinh ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></p>
                <p>Địa chỉ thường trú: <span style="text-decoration: underline;">.......................................................</span></p>

                <p><strong>Điều 1: Thời hạn hợp đồng</strong></p>
                <ul>
                    <li>Loại hợp đồng: Xác định thời hạn</li>
                    <li>Thời hạn hợp đồng: Từ ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span> đến ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></li>
                </ul>
                <p><strong>Đại diện người sử dụng lao động</strong></p>
                <p>Chức vụ: <span style="text-decoration: underline;">..................................</span></p>
                <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>

                <p><strong>Người lao động</strong></p>
                <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>
                ',
                'tinh_trang' => 1,
            ],
            [
                'ten_hop_dong' => 'Hợp Đồng Lao Động Không Xác Định Thời Hạn',
                'noi_dung' => '<div style="text-align: center;">
                    <p><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
                    <p><strong>Độc lập - Tự do - Hạnh phúc</strong></p>
                    <p>-------oOo-------</p>
                    <p><strong>HỢP ĐỒNG LAO ĐỘNG KHÔNG XÁC ĐỊNH THỜI HẠN</strong></p>
                    <p>Số: ....../HĐLĐ/20....</p>
                </div>

                <p>Chúng tôi, một bên là Ông/Bà: <span style="text-decoration: underline;">..........................................</span> Quốc tịch: Việt Nam</p>
                <p>Chức vụ: <strong>GIÁM ĐỐC</strong></p>
                <p>Đại diện cho (1) CÔNG TY: <span style="text-decoration: underline;">...........................................</span></p>
                <p>Địa chỉ: <span style="text-decoration: underline;">...............................................................</span></p>
                <p>Và một bên là Ông/Bà: <span style="text-decoration: underline;">.................................................</span> Quốc tịch: Việt Nam</p>
                <p>Sinh ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></p>
                <p>Địa chỉ thường trú: <span style="text-decoration: underline;">.......................................................</span></p>

                <p><strong>Điều 1: Thời hạn hợp đồng</strong></p>
                <ul>
                    <li>Loại hợp đồng: Không xác định thời hạn</li>
                    <li>Ngày bắt đầu làm việc: <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></li>
                </ul>
                <p><strong>Đại diện người sử dụng lao động</strong></p>
                <p>Chức vụ: <span style="text-decoration: underline;">..................................</span></p>
                <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>

                <p><strong>Người lao động</strong></p>
                <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>
                ',
                'tinh_trang' => 1,
            ],
            [
                'ten_hop_dong' => 'Hợp Đồng Thời Vụ',
                'noi_dung' => '<div style="text-align: center;">
                                <p><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
                                <p><strong>Độc lập - Tự do - Hạnh phúc</strong></p>
                                <p>-------oOo-------</p>
                                <p><strong>HỢP ĐỒNG LAO ĐỘNG THỜI VỤ</strong></p>
                                <p>Số: ....../HĐLĐ/20....</p>
                            </div>

                            <p>Chúng tôi, một bên là Ông/Bà: <span style="text-decoration: underline;">..........................................</span> Quốc tịch: Việt Nam</p>
                            <p>Chức vụ: <strong>GIÁM ĐỐC</strong></p>
                            <p>Đại diện cho (1) CÔNG TY: <span style="text-decoration: underline;">...........................................</span></p>
                            <p>Địa chỉ: <span style="text-decoration: underline;">...............................................................</span></p>
                            <p>Và một bên là Ông/Bà: <span style="text-decoration: underline;">.................................................</span> Quốc tịch: Việt Nam</p>
                            <p>Sinh ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></p>
                            <p>Địa chỉ thường trú: <span style="text-decoration: underline;">.......................................................</span></p>
                            <p>Số CMND/CCCD: <span style="text-decoration: underline;">......................................</span> Tại Công an: <span style="text-decoration: underline;">...............................</span></p>

                            <p><strong>Điều 1: Thời hạn và công việc hợp đồng</strong></p>
                            <ul>
                                <li>Loại hợp đồng lao động: Thời vụ</li>
                                <li>Thời hạn hợp đồng: Từ ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span> đến ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></li>
                                <li>Địa điểm làm việc: <span style="text-decoration: underline;">.......................................................</span></li>
                                <li>Chức vụ: <span style="text-decoration: underline;">.......................................................</span></li>
                            </ul>
                            <p><strong>Đại diện người sử dụng lao động</strong></p>
                            <p>Chức vụ: <span style="text-decoration: underline;">..................................</span></p>
                            <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>

                            <p><strong>Người lao động</strong></p>
                            <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>
                            ',
                            'tinh_trang' => 1,
                        ],
                        [
                            'ten_hop_dong' => 'Hợp Đồng Thử Việc',
                            'noi_dung' => '<div style="text-align: center;">
                <p><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
                <p><strong>Độc lập - Tự do - Hạnh phúc</strong></p>
                <p>-------oOo-------</p>
                <p><strong>HỢP ĐỒNG THỬ VIỆC</strong></p>
                <p>Số: ....../HĐTV/20....</p>
            </div>

            <p>Chúng tôi, một bên là Ông/Bà: <span style="text-decoration: underline;">..........................................</span> Quốc tịch: Việt Nam</p>
            <p>Chức vụ: <strong>GIÁM ĐỐC</strong></p>
            <p>Đại diện cho (1) CÔNG TY: <span style="text-decoration: underline;">...........................................</span></p>
            <p>Địa chỉ: <span style="text-decoration: underline;">...............................................................</span></p>
            <p>Và một bên là Ông/Bà: <span style="text-decoration: underline;">.................................................</span> Quốc tịch: Việt Nam</p>
            <p>Sinh ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></p>
            <p>Địa chỉ thường trú: <span style="text-decoration: underline;">.......................................................</span></p>

            <p><strong>Điều 1: Thời gian thử việc</strong></p>
            <ul>
                <li>Thời gian thử việc: Từ ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span> đến ngày <span style="text-decoration: underline;">......</span> tháng <span style="text-decoration: underline;">......</span> năm <span style="text-decoration: underline;">......</span></li>
            </ul>
            <p><strong>Đại diện người sử dụng lao động</strong></p>
            <p>Chức vụ: <span style="text-decoration: underline;">..................................</span></p>
            <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>

            <p><strong>Người lao động</strong></p>
            <p>Ký tên: <span style="text-decoration: underline;">..................................</span></p>
            ',
                'tinh_trang' => 1,
            ],
        ]);
    }
}
