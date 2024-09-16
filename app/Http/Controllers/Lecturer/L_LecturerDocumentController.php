<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\Courses;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class L_LecturerDocumentController extends Controller
{
    public function index(Request $request, string $nidn)
    {
        $user = Auth::user();
        $attendanceLists = AttendanceList::select('attendance_lists.id', 'attendance_lists.student_class_id', 'attendance_lists.course_id', 'attendance_lists.lecturer_id');

        if ($request->has('search')) {
            $search = $request->input('search');

            $attendanceLists->where(function ($q) use ($search) {
                $q->where('student_classes.name', 'LIKE', "%{$search}%")
                    ->orWhere('courses.name', 'LIKE', "%{$search}%")
                    ->orWhere('lecturers.name', 'LIKE', "%{$search}%");
            });
        }

        $data = $attendanceLists->paginate(5);

        return view('lecturer.l_lecturer_document.index', compact('user', 'data'));
    }

    public function details()
    {
        $attendanceList = AttendanceList::first();
        $data = AttendanceListDetail::get();

        if ($attendanceList) {
            $semester = $attendanceList->student_class->calculateSemester();

            $academicYear = $attendanceList->student_class->calculateAcademicYear($semester);
        } else {
            $semester = null;
            $academicYear = null;
        }

        return view('lecturer.l_lecturer_document.details', compact('attendanceList', 'data', 'semester', 'academicYear'));
    }

    public function create(){
        $al = AttendanceList::first();

        $selectedMeetings = AttendanceListDetail::where('attendance_list_id', $al->id)
        ->pluck('meeting_order')
        ->toArray();
        return view('lecturer.l_lecturer_document.create', compact('al', 'selectedMeetings'));
    }

    public function store(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'meeting_order' => 'required|integer',
            'course_status' => 'required|integer',
            'start_hour' => 'required|integer',
            'end_hour' => 'required|integer',
            'material_course' => 'required|string',
            'learning_methods' => 'required|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $atendance = AttendanceList::first();
            $journal = Journal::first();

            $al = new AttendanceListDetail();
            $al->attendance_list_id = $atendance->id;
            $al->meeting_order = $request->meeting_order;
            $al->course_status = $request->course_status;
            $al->start_hour = $request->start_hour;
            $al->end_hour = $request->end_hour;
            
            $al->save();

            // Simpan data Journal
            $jo = new JournalDetail();
            $jo->journal_id = $journal->id;
            $jo->meeting_order = $request->meeting_order;
            $jo->course_status = $request->course_status;
            $jo->material_course = $request->material_course;
            $jo->learning_methods = $request->learning_methods;
            $jo->save();

            DB::commit();
            return redirect()->route('lecturer.lecturer_document.details')->with('success', 'Daftar Hadir dan Jurnal berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }

    }

    public function edit(){
        return view('lecturer.l_lecturer_document.edit');
    }

    // public function student_class_index(string $id)
    // {
    //     $course = Courses::where('id', $id)->firstOrFail();
    //     $student_classes = StudentClass::whereHas('course', function ($query) use ($id) {
    //         $query->where('courses.id', $id);
    //     })->get();
    // return view('lecturer_document.student_class_index', compact('course', 'student_classes'));
    // }
    // public function lecturer_document_index(string $id, string $nidn)
    // {
    //     $student_classes = StudentClass::where('id', $id)->firstOrFail();
    //     $student = $student_classes->students;
    //     $lecturer = Lecturer::where('nidn', $nidn)->firstOrFail();
    //     $courses = $lecturer->course;
    //     $position = $lecturer->position;

    //     return view('lecturer_document.student_class_index', compact('student_classes', ''));
    // }
}
