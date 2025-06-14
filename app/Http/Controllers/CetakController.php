<?php

namespace App\Http\Controllers;

use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakController extends Controller
{
    public function cetak_dh($id){
        $data = AttendanceList::with('kajur')->findOrFail($id);
        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();
            $semester = $data->student_class->calculateSemester();
            $academicYear = $student_class->calculateAcademicYear($semester);

            $students = $student_class->students;

            $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->orderBy('meeting_order', 'asc')->get();
            $fileName = "Daftar Hadir Perkuliahan-{$data->course->code} - {$data->course->name} .pdf";
            $pdf = Pdf::loadView('cetak.cetak_dh', compact('data', 'semester', 'academicYear', 'students','attendencedetail'))
            ->setPaper('a4', 'portrait');

        return $pdf->download($fileName);
            // return view('cetak.cetak_dh', compact('data', 'semester', 'academicYear', 'students','attendencedetail'));
    }
    public function cetak_jurnal($id)
    {
        $data = AttendanceList::with('kajur')->findOrFail($id);
        
        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();
            $semester = $data->student_class->calculateSemester();
            $academicYear = $student_class->calculateAcademicYear($semester);

            $students = $student_class->students;

            $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->orderBy('meeting_order', 'asc')->get();
            $fileName = "Jurnal Perkuliahan -{$data->course->code} - {$data->course->name}.pdf";
            $pdf = Pdf::loadView('cetak.cetak_jurnal', compact('data', 'semester', 'academicYear', 'students','attendencedetail'))
            ->setPaper('a4', 'portrait'); 

        return $pdf->download($fileName);
    }
}
