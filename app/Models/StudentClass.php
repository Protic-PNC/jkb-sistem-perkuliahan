<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'academic_year',
        'study_program_id',
    ];

    public function study_program(){
        return $this->belongsTo(StudyProgram::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'student_class_id');
    }

    public function course(){
        //pivot table (many to many)
        return $this->belongsToMany(Courses::class, 'course_classes','student_class_id', 'course_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    }
    

    
}
