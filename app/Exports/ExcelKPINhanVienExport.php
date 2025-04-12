<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelKPINhanVienExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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

    public function map($invoice): array
    {
        return [
            $invoice->stt,
            $invoice->ho_va_ten,
            $invoice->ten_tieu_chi,
            $invoice->diem_duoc_cham,
            $invoice->ten_nhan_vien_danh_gia,
            $invoice->ngay_danh_gia,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Nhân Viên',
            'Tên KPI',
            'Điểm Được Chấm',
            'Người Đánh Giá',
            'Ngày Đánh Giá',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
