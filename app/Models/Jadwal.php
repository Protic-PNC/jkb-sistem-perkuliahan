<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'prodi_id',
        'file',
    ];

    public function prodi()
    {
        return $this->belongsTo(StudyProgram::class,'prodi_id', 'id');
    }
}
