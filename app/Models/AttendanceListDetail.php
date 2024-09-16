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
        'meeting_hour',
        'sum_attendance_students',
        'has_acc_student',
        'has_acc_lecturer',
        'signature_student',
        'signature_lecturer',
    ];

    public function attendenceList(){
        return $this->belongsTo(AttendanceList::class);
    }

    

   

    
}
