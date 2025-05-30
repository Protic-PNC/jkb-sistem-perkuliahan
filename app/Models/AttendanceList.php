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
        'lecturer_id',
        'course_id',
        'student_class_id',
        'has_finished',
        'date_finished',
        'has_acc_kajur',
        'date_acc_kajur',
        'student_id',
        'lecturer_kajur_id',
        'periode_id',
    ];

    //has finished, jika 0 = aktif, 1 = dokumen selesai, 2 acc kajur

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }
    public function lecturer(){
        return $this->belongsTo(Lecturer::class, 'lecturer_id', 'id');
    }
    public function periode(){
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
    public function course(){
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function attendanceListDetails(){ //attendence list details
        return $this->hasMany(AttendanceListDetail::class, 'attendance_list_id','id');
    }

   public function journal()
{
    return $this->hasOne(Journal::class, 'attendance_list_id');
}
}
