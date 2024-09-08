<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceList extends Model
{
    use HasFactory;

    protected $table = 'attendance_lists';

    protected $fillable = [
        'code_al',
        'has_finished',
        'has_acc_head_departement',
        'student_class_id',
        'course_id',
        'lecturer_id',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
    public function course(){
        return $this->belongsTo(Courses::class);
    }
    public function student_class(){
        return $this->belongsTo(StudentClass::class);
    }

    public function attendanceListDetails(){ //attendence list details
        return $this->hasMany(AttendanceListDetail::class);
    }

    public function journal(){
        return $this->hasOne(Journal::class);
    } //1 daftar hadir punay 1 jurnal
}
