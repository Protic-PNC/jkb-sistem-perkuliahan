<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\AttendanceListStudent;
use App\Models\Courses;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\Lecturer;
use App\Models\Student;
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

    public function create()
    {
        $al = AttendanceList::first();

        $students = Student::where('student_class_id', $al->student_class_id);

        $selectedMeetings = AttendanceListDetail::where('attendance_list_id', $al->id)
            ->pluck('meeting_order')
            ->toArray();
        return view('lecturer.l_lecturer_document.create', compact('al', 'selectedMeetings', 'students'));
    }

    public function store(Request $request)
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

    
    public function edit(string $id)
    {
        $ad = AttendanceListDetail::find($id);
        $journal = JournalDetail::find($id);
        $al = AttendanceList::first();

        $students = Student::where('student_class_id', $al->student_class_id);

        $selectedMeetings = AttendanceListDetail::where('attendance_list_id', $al->id)
            ->pluck('meeting_order')
            ->toArray();

        return view('lecturer.l_lecturer_document.edit', compact('ad', 'al', 'selectedMeetings', 'students', 'journal'));
    }

    public function update(string $id, Request $request)
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

            $al = AttendanceListDetail::find($id);
            $al->attendance_list_id = $atendance->id;
            $al->meeting_order = $request->meeting_order;
            $al->course_status = $request->course_status;
            $al->start_hour = $request->start_hour;
            $al->end_hour = $request->end_hour;

            $al->save();

            // Simpan data Journal
            $jo = JournalDetail::find($id);
            $jo->journal_id = $journal->id;
            $jo->meeting_order = $request->meeting_order;
            $jo->course_status = $request->course_status;
            $jo->material_course = $request->material_course;
            $jo->learning_methods = $request->learning_methods;
            $jo->save();

            DB::commit();
            return redirect()->route('lecturer.lecturer_document.details')->with('success', 'Daftar Hadir dan Jurnal berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }


    public function storeStudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_list_detail_id' => 'required|exists:attendance_list_details,id',
            'student_ids' => 'required|array',
            'attendance_student' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $student_ids = $request->student_ids;
            $attendances = $request->attendance_student;

            foreach ($student_ids as $index => $student_id) {
                AttendanceListStudent::create([
                    'attendance_list_detail_id' => $request->attendance_list_detail_id,
                    'student_id' => $student_id,
                    'attendance_status' => $attendances[$index],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Student attendance has been saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'An error occurred while saving student attendance: ' . $e->getMessage());
        }
    }
}
