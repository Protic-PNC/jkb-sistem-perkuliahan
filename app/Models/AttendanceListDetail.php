<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceListDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'attendence_list_id',
        'student_id',
        'attendence_student',
        'course_status',
        'has_acc_student',
        'has_acc_lecturer',
    ];

    public function attendenceList(){
        return $this->belongsTo(AttendanceList::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function journalDetail(){
        return $this->hasOne(JournalDetail::class);
    }


    //buat method jumlah hadir

    
}
