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
        'meeting_order',
        'course_status',
        'material_course',
        'learning_methods',
        'sum_attendance_students',
        'has_acc_student',
        'has_acc_lecturer',
        'signature_student',
        'signature_lecturer',
        'signature_kaprodi',
        'signature_kajur',
        'date_signature_kaprodi',
        'date_signature_kajur',
        'note',

    ];

    public function journal(){ //attendence list, attendencelist dan journal 
        return $this->belongsTo(Journal::class);
    }


    
}
