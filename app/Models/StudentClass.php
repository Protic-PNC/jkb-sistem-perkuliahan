<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'academic_year',
        'study_program_id',
    ];

    public function study_program(){
        return $this->hasOne(StudyProgram::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }

    
}
