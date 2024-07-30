<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function student_class(){
        return $this->belongsTo(StudentClass::class);
    }

}
