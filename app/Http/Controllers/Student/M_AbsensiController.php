<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M_AbsensiController extends Controller
{
    public function absensi_mahasiswa()
    {
        return view('student.absensi.absensi_mahasiswa');
    }
}
