<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable= [
        'name',
        'nim',
        'address',
        'number_phone',
        'student_class_id',
        'user_id',
        'signature',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'student_class_id','id');
    }

    public function attendence_list_student(){
        return $this->hasMany(AttendanceListStudent::class, 'student_id');

    }
    
}
