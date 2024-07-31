<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LecturerPosition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lecturer_id',
        'position_id',
    ];
}
