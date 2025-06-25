<?php

namespace Database\Seeders;

use App\Models\Courses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Pemrograman Web',
                'type' => 'praktikum',
                'sks' => 2,
                'hours' => 16,
                'meeting' => 2,
            ],
            [
                'name' => 'Algoritma dan Struktur Data',
                'type' => 'teori',
                'sks' => 3,
                'hours' => 24,
                'meeting' => 4,
            ],
            [
                'name' => 'Basis Data',
                'type' => 'teori',
                'sks' => 3,
                'hours' => 24,
                'meeting' => 12,
            ],
            [
                'name' => 'Jaringan Komputer',
                'type' => 'teori',
                'sks' => 3,
                'hours' => 24,
                'meeting' => 12,
            ],
            [
                'name' => 'Kecerdasan Buatan',
                'type' => 'teori',
                'sks' => 2,
                'hours' => 16,
                'meeting' => 2,
            ],
            [
                'name' => 'Pemrograman Mobile',
                'type' => 'praktikum',
                'sks' => 2,
                'hours' => 16,
                'meeting' => 2,
            ],
        ];

        foreach ($courses as $course) {
            Courses::create([
                'code' => strtoupper(Str::random(6)),
                'name' => $course['name'],
                'type' => $course['type'],
                'sks' => $course['sks'],
                'hours' => $course['hours'],
                'meeting' => $course['meeting'],
            ]);
        }
    }
}
