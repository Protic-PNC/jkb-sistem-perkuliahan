<?php

namespace App\Http\Controllers;

use App\Models\AttendenceList;
use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(string $id)
    // {
    //     // Retrieve the student class by its ID along with related students and courses
    //     $student_class = StudentClass::with(['students', 'course'])
    //         ->where('id', $id)
    //         ->firstOrFail();

    //     // Get the authenticated lecturer
    //     $lecturer = Auth::user()->lecturer;

    //     // Retrieve the specific course associated with the lecturer and the student class
    //     $course = $lecturer
    //         ->course()
    //         ->whereHas('studentClasses', function ($query) use ($id) {
    //             $query->where('student_class_id', $id);
    //         })
    //         ->where('courses.id', $student_class->course->first()->id) // Ensure the correct course is retrieved
    //         ->first();

    //     if ($course) {
    //         // Calculate the semester
    //         $semester = $student_class->calculateSemester();

    //         // Calculate the academic year
    //         $academicYear = $student_class->calculateAcademicYear($semester);

    //         // Get the students for the student class
    //         $students = $student_class->students;

    //         return view('lecturer_document.attendence_list.index', compact('student_class', 'lecturer', 'course', 'semester', 'academicYear', 'students'));
    //     } else {
    //         // Handle the case where the course is not found or not associated with this student class
    //         return redirect()->route('some.route')->with('error', 'Course not found or not associated with this student class.');
    //     }
    // }

    public function index(string $classId, string $courseId)
    {
        // Retrieve the course
        $course = Courses::findOrFail($courseId);

        // Retrieve the student class
        $student_class = StudentClass::findOrFail($classId);

        // Verify that the student class belongs to the course
        if (!$course->studentClasses->contains($student_class)) {
            return redirect()->route('lecturer_document.course')->with('error', 'Invalid student class for this course.');
        }

        // Get the authenticated lecturer
        $lecturer = Auth::user()->lecturer;

        // Verify that the lecturer is associated with this course
        if (!$lecturer->course->contains($course)) {
            return redirect()->route('lecturer_document.course')->with('error', 'You are not authorized to access this course.');
        }

        // Calculate the semester
        $semester = $student_class->calculateSemester();

        // Calculate the academic year
        $academicYear = $student_class->calculateAcademicYear($semester);

        // Get the students for the student class
        $students = $student_class->students;

        return view('lecturer_document.attendence_list.index', compact('student_class', 'lecturer', 'course', 'semester', 'academicYear', 'students'));
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
