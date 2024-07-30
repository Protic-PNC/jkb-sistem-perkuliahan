<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendenceListDetail extends Model
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

    //buat method jumlah hadir

    
}
