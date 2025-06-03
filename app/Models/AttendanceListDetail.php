<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceListDetail extends Model
{
    use HasFactory;

    protected $table = 'attendance_list_details';
    protected $fillable = [
        'attendance_list_id',
        'meeting_order',
        'course_status',
        'start_hour',
        'end_hour',
        'sum_attendance_students',
        'sum_late_students',
        'has_acc_student',
        'has_acc_lecturer',
        'student_id',
        'date_acc_student',
        'date_acc_lecturer',
    ];

    public function attendenceList(){
        return $this->belongsTo(AttendanceList::class, 'attendance_list_id', 'id');
    }
    

    public function journal_detail()
    {
        return $this->belongsTo(JournalDetail::class  ,'id', 'attendance_list_detail_id');
    }

    public function attendence_list_student()
{
    return $this->hasMany(AttendanceListStudent::class);
}

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    

   

    
}
