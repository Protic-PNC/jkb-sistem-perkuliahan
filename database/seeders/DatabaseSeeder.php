<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(StudentClassSeeder::class);
    }
}
