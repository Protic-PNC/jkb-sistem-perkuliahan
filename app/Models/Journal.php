<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'has_finished',
        'has_acc_head_departement',
        'lecturer_id',
        'course_lecturer_id',
        'student_class_id',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
    public function course(){
        return $this->belongsTo(Courses::class);
    }
    public function student_class(){
        return $this->hasOne(StudentClass::class);
    }

    
}
