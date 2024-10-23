<?php

namespace App\Exports\Masterdata;

use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class Student_ClassExport implements FromQuery, WithMapping, WithHeadings, WithTitle, WithStyles, WithCustomStartCell
{
    private $rowNumber = 1;

    public function query()
    {
        return StudentClass::query();
    }

    public function headings(): array
    {
        return [
            'No',
            'KODE',
            'NAMA',
            'TAHUN AKADEMIK',
        ];
    }

    public function map($class): array
    {
        return [
            $this->rowNumber++,
            $class->code,
            $class->name,
            $class->academic_year,
        ];
    }

    public function title(): string
    {
        return 'Data Kelas Jurusan Komputer dan Bisnis';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('A1', 'Data Kelas Jurusan Komputer dan Bisnis');

        $sheet->mergeCells('A1:F1');

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        return [
            3 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
        ];
    }

    public function startCell(): string
    {
        return 'A3'; 
    }
}
