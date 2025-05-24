<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalDetail extends Model
{
    use HasFactory;

    protected $table = 'journal_details';
    protected $fillable = [
        'journal_id',
        'attendance_list_detail_id',
        'material_course',
        'learning_methods',
        'has_acc_student',
        'has_acc_lecturer',
        'has_acc_kaprodi',
        'student_id',
        'lecturer_kaprodi_id',
        'date_acc_student',
        'date_acc_lecturer',
        'date_acc_kaprodi',
        'note'

    ];

    public function journal(){ //attendence list, attendencelist dan journal 
        return $this->belongsTo(Journal::class);
    }
    public function attendance_list_detail(){ //attendence list, attendencelist dan journal 
        return $this->belongsTo(AttendanceListDetail::class);
    }
    public function kaprodi(){ //attendence list, attendencelist dan journal 
        return $this->belongsTo(Lecturer::class, 'lecturer_kaprodi_id', 'id');
    }


    
}
