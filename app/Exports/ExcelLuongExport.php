<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelLuongExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            $invoice->ca_sang,
            $invoice->ca_chieu,
            $invoice->ca_toi,
            $invoice->tong_so_buoi,
            $invoice->diem_thuong_phat,
            $invoice->diem_KPI,
            $invoice->tien_thuc_nhan,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên Nhân Viên',
            'Số Ca Sáng',
            'Số Ca Chiều',
            'Số Ca Tối',
            'Tổng Số Buổi',
            'Thưởng/Phạt',
            'KPI',
            'Tiền Thực Nhận',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
