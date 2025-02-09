<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jenjang',
        'brief',
    ];

    public function student_class(){
        return $this->hasOne(StudentClass::class);
    }


}
