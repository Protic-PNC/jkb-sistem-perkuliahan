<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'material',
        'has_acc_student',
        'has_acc_lecturer',
        'attendence_list_detail_id',
        'journal_id',
    ];

    public function journal(){ //attendence list, attendencelist dan journal 
        return $this->belongsTo(Journal::class);
    }

    public function attendenceListDetail(){
        return $this->belongsTo(AttendenceListDetail::class);
    }

    
}
