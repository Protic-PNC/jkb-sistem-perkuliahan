<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    
    protected $fillable = [
        'tahun',
        'tahun_akademik',
        'semester',
        'status',
        'tanggal_batas_awal',
        'tanggal_batas_akhir'
    ];
    use HasFactory;
}
