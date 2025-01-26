<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'prodi_id'
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }

    public function prodis()
    {
        return $this->belongsTo(StudyProgram::class, 'prodi_id', 'id');
    }
}
