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
        return $this->belongsTo(Courses::class);
       }
}
