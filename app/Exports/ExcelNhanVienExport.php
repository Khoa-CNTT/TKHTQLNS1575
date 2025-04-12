<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelNhanVienExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            $invoice->email,
            $invoice->ngay_sinh,
            $invoice->so_dien_thoai,
            $invoice->dia_chi,
            $invoice->luong_co_ban,
            $invoice->ten_chuc_vu,
            $invoice->ten_phong_ban,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Họ Và Tên',
            'Email',
            'Ngày Sinh',
            'Số Điện Thoại',
            'Địa Chỉ',
            'Lương Cơ Bản',
            'Tên Chức Vụ',
            'Tên Phòng Ban',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
