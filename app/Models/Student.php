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
        'signature',
        'user_id',
        'student_class_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function student_class(){
        return $this->belongsTo(StudentClass::class);
    }

    public function attendence_list(){
        //pivot table (many to many)
        return $this->belongsToMany(AttendenceList::class, 'attendence_list_details','student_id', 'attendence_list_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    }
    
}
