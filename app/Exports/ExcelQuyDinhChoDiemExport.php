<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelQuyDinhChoDiemExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            $invoice->ma_so,
            $invoice->so_diem,
            $invoice->noi_dung,
            $invoice->ghi_chu,
            $invoice->loai_diem,
        ];
    }

    public function headings(): array
    {
        return [
            'STT',
            'Mã Số',
            'Số Điểm',
            'Nội Dung',
            'Ghi Chú',
            'Loại Điểm'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    }
}
