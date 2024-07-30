<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'number_phone',
        'address',
        'nidn',
        'nip',
        'user_id',
        'course_id',
        'position_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        //pivot table (many to many)
        return $this->belongsToMany(Courses::class, 'course_lecturers','lecturer_id', 'course_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    }
    public function position(){
        //pivot table (many to many)
        return $this->belongsToMany(Position::class, 'lecturer_positions','lecturer_id', 'position_id')->wherePivotNull('deleted_at')
        ->withPivot('id');
    }
}