<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
        ['name' => 'Teknik Informatika', 'jenjang' => 'D3', 'brief' => 'TI'],
        ['name' => 'Akuntansi Lembaga Keuangan Syariah', 'jenjang' => 'D4', 'brief' => 'ALKS'],
        ['name' => 'Rekayasa Keamanan Siber', 'jenjang' => 'D4', 'brief' => 'RKS'],
        ['name' => 'Teknologi Rekayasa Multimedia', 'jenjang' => 'D4', 'brief' => 'TRM'],
        ['name' => 'Rekayasa Perangkat Lunak', 'jenjang' => 'D4', 'brief' => 'RPL'],
        ];

        foreach ($programs as $program) {
            StudyProgram::create($program);
        }

         $position = Position::create([
            'name' => 'Kepala Jurusan',
            'prodi_id' => null,
            
        ]);
         $position = Position::create([
            'name' => 'Koordinator Program Studi',
            'prodi_id' => 1,
        ]);
         $position = Position::create([
            'name' => 'Koordinator Program Studi',
            'prodi_id' => 2,
        ]);
         $position = Position::create([
            'name' => 'Koordinator Program Studi',
            'prodi_id' => 3,
        ]);
         $position = Position::create([
            'name' => 'Koordinator Program Studi',
            'prodi_id' => 4,
        ]);
         $position = Position::create([
            'name' => 'Koordinator Program Studi',
            'prodi_id' => 5,
        ]);
    }
}
