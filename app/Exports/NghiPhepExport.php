<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NghiPhepExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($row): array
    {
        $tinhTrang = '';
        switch ($row->tinh_trang) {
            case 0:
                $tinhTrang = 'Chờ duyệt';
                break;
            case 1:
                $tinhTrang = 'Đã duyệt';
                break;
            case 2:
                $tinhTrang = 'Từ chối';
                break;
            default:
                $tinhTrang = 'Chờ duyệt';
                break;
        }
        
        return [
            $row->stt,
            $row->ho_va_ten,
            $row->ten_loai_vang,
            $row->ngay_bat_dau,
            $row->ngay_ket_thuc,
            $row->so_ngay_vang,
            $row->ly_do,
            $tinhTrang,
            $row->ghi_chu,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Nhân viên',
            'Loại vắng',
            'Ngày bắt đầu',
            'Ngày kết thúc',
            'Số ngày vắng',
            'Lý do',
            'Tình trạng',
            'Ghi chú'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
