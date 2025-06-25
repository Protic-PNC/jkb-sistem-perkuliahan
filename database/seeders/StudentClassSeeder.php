<?php

namespace Database\Seeders;

use App\Models\CourseClass;
use App\Models\Courses;
use Illuminate\Database\Seeder;
use App\Models\StudentClass;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\DB;

class StudentClassSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar program studi dengan ID tetap
        $programs = [
            ['id' => 1, 'brief' => 'TI'],
            ['id' => 2, 'brief' => 'ALKS'],
            ['id' => 3, 'brief' => 'RKS'],
            ['id' => 4, 'brief' => 'TRM'],
            ['id' => 5, 'brief' => 'RPL'],
        ];

        $classMap = [
            'TI' => [
                2022 => 2,
                2023 => 3,
            ],
            'RKS' => [
                2022 => 3,
            ],
            'ALKS' => [
                2022 => 1,
            ],
            'TRM' => [
                2023 => 2,
            ],
            'RPL' => [
                2023 => 2,
            ],
        ];

        $classLetters = range('A', 'D');
        $level = 1;
        $status = 1;

        foreach ($programs as $program) {
            $brief = $program['brief'];
            $programId = $program['id'];

            if (!isset($classMap[$brief])) continue;

            foreach ($classMap[$brief] as $year => $classCount) {
                for ($i = 0; $i < $classCount; $i++) {
                    $className = $classLetters[$i];
                    $code = $brief . $className . $year;

                    StudentClass::create([
                        'name' => $className,
                        'code' => $code,
                        'level' => $level,
                        'academic_year' => $year,
                        'study_program_id' => $programId,
                        'status' => $status,
                    ]);
                }
            }
        }

        $classes = StudentClass::all();
        $courses = Courses::all();

        foreach ($classes as $class) {
            // Acak 2 sampai 4 course dari daftar course
            $randomCourses = $courses->random(rand(2, 4));

            foreach ($randomCourses as $course) {
                CourseClass::create([
                    'student_class_id' => $class->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
