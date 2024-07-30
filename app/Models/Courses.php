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
        'sks',
        'hours',
        'student_class_id',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
    public function studentClasses()
    {
        //pivot table (many to many)
        return $this->belongsToMany(StudentClass::class, 'course_classes','student_class_id', 'course_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    
    }
}
