<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PeriodeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($year = 2022; $year <= 2025; $year++) {
            // Semester Ganjil
            $data[] = [
                'tahun' => $year,
                'tahun_akademik' => $year . '/' . ($year + 1),
                'semester' => 'Ganjil',
                'status' => 1,
                'tanggal_batas_awal' => "$year-07-01",
                'tanggal_batas_akhir' => "$year-12-31",
            ];

            // Semester Genap
            $data[] = [
                'tahun' => $year,
                'tahun_akademik' => $year . '/' . ($year + 1),
                'semester' => 'Genap',
                'status' => 1,
                'tanggal_batas_awal' => ($year + 1) . "-01-01",
                'tanggal_batas_akhir' => ($year + 1) . "-06-30",
            ];
        }

        foreach ($data as $periode) {
            Periode::create($periode);
        }
    }
}
