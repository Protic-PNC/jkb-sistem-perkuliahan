<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'journals';
    protected $fillable = [
        'lecturer_id',
        'course_id',
        'student_class_id',
        'has_finished',
        'has_acc_kajur',
        'signature_kajur',
        'date_signature_kajur',

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

    public function journalDetails(){
        return $this->hasMany(JournalDetail::class);
    }

    
}
