<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'sks',
        'hours',
        'student_class_id',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
}
