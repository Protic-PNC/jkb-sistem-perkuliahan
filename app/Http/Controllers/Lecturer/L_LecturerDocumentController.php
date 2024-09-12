<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class L_LecturerDocumentController extends Controller
{
    public function index(Request $request, string $nidn)
    {
        $user = Auth::user();
        $attendanceLists = AttendanceList::select(
            'attendance_lists.student_class_id',
            'attendance_lists.course_id',
            'attendance_lists.lecturer_id',
            'student_classes.name as student_class_name',
            'courses.name as course_name',
            'lecturers.name as lecturer_name'
        )
        ->join('student_classes', 'attendance_lists.student_class_id', '=', 'student_classes.id')
        ->join('courses', 'attendance_lists.course_id', '=', 'courses.id')
        ->join('lecturers', 'attendance_lists.lecturer_id', '=', 'lecturers.id');
        
        // Jika ada parameter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
        
            // Tambahkan kondisi pencarian berdasarkan kolom yang dipilih
            $attendanceLists->where(function ($q) use ($search) {
                $q->where('student_classes.name', 'LIKE', "%{$search}%")
                  ->orWhere('courses.name', 'LIKE', "%{$search}%")
                  ->orWhere('lecturers.name', 'LIKE', "%{$search}%");
            });
        }
        
        // Gunakan paginate untuk paginasi hasil query
        $data = $attendanceLists->paginate(5);
        
        return view('lecturer_document.index', compact('user', 'data'));
    }
    public function student_class_index(string $id)
    {
        $course = Courses::where('id', $id)->firstOrFail();
        $student_classes = StudentClass::whereHas('course', function ($query) use ($id) {
            $query->where('courses.id', $id);
        })->get();
    return view('lecturer_document.student_class_index', compact('course', 'student_classes'));
    }
    public function lecturer_document_index(string $id, string $nidn)
    {
        $student_classes = StudentClass::where('id', $id)->firstOrFail();
        $student = $student_classes->students;
        $lecturer = Lecturer::where('nidn', $nidn)->firstOrFail();
        $courses = $lecturer->course;
        $position = $lecturer->position;

        return view('lecturer_document.student_class_index', compact('student_classes', ''));
    }
}
