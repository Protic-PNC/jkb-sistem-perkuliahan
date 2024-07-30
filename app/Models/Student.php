<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable= [
        'nim',
        'name',
        'address',
        'user_id',
        'student_class_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function student_class(){
        return $this->hasOne(StudentClass::class);
    }
}
