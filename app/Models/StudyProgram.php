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

   
    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function jadwal(){
    return $this->hasOne(Jadwal::class, 'prodi_id', 'id');
}
   


}
