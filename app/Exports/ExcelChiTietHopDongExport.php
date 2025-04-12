<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelChiTietHopDongExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            $invoice->ten_hop_dong,
            $invoice->noi_dung,
            $invoice->ngay_bat_dau,
            $invoice->ngay_ket_thuc,
            $invoice->ngay_ky,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên Nhân Viên',
            'Loại Hợp Đồng',
            'Nội Dung',
            'Ngày Bắt Đầu',
            'Ngày Kết Thúc',
            'Ngày Ký',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
