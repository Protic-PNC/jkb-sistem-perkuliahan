<?php

namespace App\Http\Controllers;

use App\Models\AttendenceList;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
      $student_class = StudentClass::with(['students', 'course'])->where('id', $id)->firstOrFail();
      $lecturer = Auth::user()->lecturer;
      $course = $lecturer->course()->whereHas('studentClasses', function($query) use ($id) {$query->where('student_class_id', $id); })->find($id);

        // Calculate the semester
        if ($course) {
            // Calculate the semester
            $semester = $student_class->calculateSemester();
    
            // Calculate the academic year
            $academicYear = $student_class->calculateAcademicYear($semester);
    
            return view('lecturer_document.attendence_list.index', compact('student_class', 'lecturer', 'course', 'semester', 'academicYear'));
        } else {
            // Handle the case where the course is not found
            return redirect()->route('some.route')->with('error', 'Course not found or not associated with this student class.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendenceList $attendenceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendenceList $attendenceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendenceList $attendenceList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendenceList $attendenceList)
    {
        //
    }
}
