<?php

namespace App\Http\Controllers\Lecturer;
use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        // Retrieve the student class by its ID along with related students and courses
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $id)
            ->firstOrFail();

        // Get the authenticated lecturer
        $lecturer = Auth::user()->lecturer;

        // Retrieve the specific course associated with the lecturer and the student class
        $course = $lecturer
            ->course()
            ->whereHas('studentClasses', function ($query) use ($id) {
                $query->where('student_class_id', $id);
            })
            ->where('courses.id', $student_class->course->first()->id) // Ensure the correct course is retrieved
            ->first();

        if ($course) {
            // Calculate the semester
            $semester = $student_class->calculateSemester();

            // Calculate the academic year
            $academicYear = $student_class->calculateAcademicYear($semester);

            // Get the students for the student class
            $students = $student_class->students;

            return view('lecturer_document.attendence_list.index', compact('student_class', 'lecturer', 'course', 'semester', 'academicYear', 'students'));
        } else {
            // Handle the case where the course is not found or not associated with this student class
            return redirect()->route('lecturer_document.attendenceList.index')->with('error', 'Course not found or not associated with this student class.');
        }
    }

    // public function index(string $classId, string $courseId)
    // {
    //     $course = Courses::findOrFail($courseId);
    //     $student_class = StudentClass::findOrFail($classId);

    //     if (!$course->studentClasses->contains($student_class)) {
    //         return redirect()->route('lecturer_document.course')->with('error', 'Invalid student class for this course.');
    //     }

    //     $lecturer = Auth::user()->lecturer;
    //     if (!$lecturer->course->contains($course)) {
    //         return redirect()->route('lecturer_document.course')->with('error', 'You are not authorized to access this course.');
    //     }
    //     $semester = $student_class->calculateSemester();
    //     $academicYear = $student_class->calculateAcademicYear($semester);
    //     $students = $student_class->students;

    //     return view('lecturer_document.attendence_list.index', compact('student_class', 'lecturer', 'course', 'semester', 'academicYear', 'students'));
    // }

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
    public function show(AttendanceList $attendanceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceList $attendanceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceList $attendanceList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceList $attendanceList)
    {
        //
    }
}
