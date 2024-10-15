<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeCoverage\Report\Xml\BuildInformation;

class StudentClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'academic_year', 'study_program_id', 'status'];

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'student_class_id');
    }

    public function course()
    {
        //pivot table (many to many)
        return $this->belongsToMany(Courses::class, 'course_classes', 'student_class_id', 'course_id')
            ->wherePivotNull('deleted_at')
            ->withPivot('id');
    }

    public function calculateSemester()
    {
        $currentYear = now()->year; // Get the current year
        $currentMonth = now()->month; // Get the current month

        // Calculate the academic year start and end years
        $academicYearStart = $this->academic_year;
        $academicYearEnd = $academicYearStart + 1;

        // Determine the current semester based on the month
        if ($currentMonth >= 7) {
            // July - December: Semester 1 of the current academic year
            $semester = 2 * ($currentYear - $academicYearStart) + 1;
        } else {
            // January - June: Semester 2 of the previous academic year
            $semester = 2 * ($currentYear - $academicYearStart - 1) + 2;
        }

        return $semester;
    }

    public function calculateAcademicYear($semester)
    {
        // Determine the base year for calculation
        $baseYear = $this->academic_year;

        // Determine the base semester (assuming starting from semester 1 in base year)
        $baseSemester = 1;

        // Calculate the total semesters passed since the base semester
        $semestersPassed = $semester - $baseSemester;

        // Determine the start year and end year based on semesters
        if ($semester % 2 == 1) {
            // For odd semesters (1, 3, 5, etc.)
            $startYear = $baseYear + intdiv($semestersPassed, 2);
        } else {
            // For even semesters (2, 4, 6, etc.)
            $startYear = $baseYear + intdiv($semestersPassed + 1, 2);
        }

        // Calculate the end year of the academic year
        $endYear = $startYear + 1;

        // Format the academic year as 'YYYY/YYYY'
        $academicYear = "{$startYear}/{$endYear}";

        return $academicYear;
    }
}
