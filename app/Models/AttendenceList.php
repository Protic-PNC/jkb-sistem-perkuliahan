<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendenceList extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code_al',
        'has_finished',
        'has_acc_head_departement',
        'lecturer_id',
        'course_lecturer_id', //ambil properti dari courses
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

    public function al_detail(){ //attendence list details
        return $this->belongsTo(AttendenceListDetail::class);
    }
}
