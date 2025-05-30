<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'sks',
        'hours',
        'meeting',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }

     public function courseLecturers()
    {
        return $this->hasMany(CourseLecturer::class, 'course_id');
    }

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'course_lecturers', 'course_id', 'lecturer_id')
                    ->using(CourseLecturer::class)
                    ->withPivot('id')
                    ->wherePivotNull('deleted_at');
    }
    public function studentClasses()
    {
        //pivot table (many to many)
        return $this->belongsToMany(StudentClass::class, 'course_classes','student_class_id', 'course_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    
    }
}
