<?php

namespace App\Exports;

use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentClassesExport implements  FromQuery, WithMapping, WithHeadings, WithTitle, WithStyles, WithCustomStartCell
{
    private $rowNumber = 1;
    public function query()
    {
        return StudentClass::with('study_program');
    }

    public function headings(): array
    {
        return [
            '#',
            'KODE KELAS',
            'NAMA KELAS',
        ];
    }

    public function map($u): array
    {
        
        return [
            $this->rowNumber++, 
            $u->code, 
            $u->study_program->name . ' ' . $u->level . ' ' . $u->name,            
        ];
    }

    public function title(): string
    {
        return 'Daftar Kelas';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('A1', 'Daftar Kelas');

        // Merge the title across all columns
        $sheet->mergeCells('A1:H1');

        // Apply styling for the title
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        // Auto-size columns
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Apply styling for the headings
        return [
            4 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

}

