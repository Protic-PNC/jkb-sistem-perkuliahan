<?php

namespace App\Http\Controllers;

use App\Models\CourseLecturer;
use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerDocumentController extends Controller
{
    public function course_index(string $nidn)
    {
      $lecturer = Lecturer::where('nidn', $nidn)->firstOrFail();
      $courses = $lecturer->course; //mengakses method model course pada lecturer
      return view('lecturer_document.course_index', compact('lecturer', 'courses'));
    }
    public function student_class_index(string $code)
    {
      $course = Courses::where('code', $code)->firstOrFail();
      $student_classes = $course->studentClasses; //mengakses method model course pada lecturer
      
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
