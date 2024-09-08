<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceListStudent extends Model
{
    use HasFactory;

    protected $table = 'attendance_list_students';

    protected $fillable = [
        'attendance_list_detail_id',
        'student_id',
        'attendence_student',
        'minutes_late',
        'note',
    ];

    public function attendenceListDetail(){
        return $this->belongsTo(AttendanceListDetail::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
