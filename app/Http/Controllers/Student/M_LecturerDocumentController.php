<?php

namespace App\Http\Controllers\Student;

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
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class M_LecturerDocumentController extends Controller
{
    public function index(Request $request, string $id)
    {
        $user = Auth::user();

        $attendanceLists = AttendanceList::select('attendance_lists.id', 'attendance_lists.student_class_id', 'attendance_lists.course_id')->where('student_class_id', $user->student->student_class_id);

        if ($request->has('search')) {
            $search = $request->input('search');

            $attendanceLists->where(function ($q) use ($search) {
                $q->where('student_classes.name', 'LIKE', "%{$search}%")
                    ->orWhere('courses.name', 'LIKE', "%{$search}%")
                    ->orWhere('lecturers.name', 'LIKE', "%{$search}%");
            });
        }

        $data = $attendanceLists->paginate(5);

        return view('student.m_lecturer_document.m_index', compact('user', 'data'));
    }

    public function details($id)
    {
        $data = AttendanceList::findOrFail($id);

        $details= AttendanceListDetail::where('attendance_list_id', $data->id)
        ->get();
        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();
        $semester = $data->student_class->calculateSemester();
        $academicYear = $student_class->calculateAcademicYear($semester);

        $students = $student_class->students;

        $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->first();

        return view('student.m_lecturer_document.m_details', compact( 'data', 'details','semester', 'academicYear', 'students'));
    }

    public function create($id)
    {
        $al = AttendanceList::findOrFail($id);

        $students = Student::where('student_class_id', $al->student_class_id);

        $selectedMeetings = AttendanceListDetail::where('attendance_list_id', $al->id)
            ->pluck('meeting_order')
            ->toArray();
        return view('student.m_lecturer_document.m_create', compact('al', 'selectedMeetings', 'students'));
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
            return redirect()->route('student.lecturer_document.m_details',  $atendance->id)->with('success', 'Daftar Hadir dan Jurnal berhasil disimpan');
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

        return view('student.m_lecturer_document.m_edit', compact('ad', 'al', 'selectedMeetings', 'students', 'journal'));
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
            return redirect()->route('student.lecturer_document.details',  $atendance->id)->with('success', 'Daftar Hadir dan Jurnal berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    public function absensi(string $id)
    {
        $ad = AttendanceListDetail::find($id);

        $al = AttendanceList::find($ad->attendance_list_id);

        $student_classes = Student::where('student_class_id', $al->student_class_id)->get();

        $attendance = AttendanceListStudent::where('attendance_list_detail_id', $ad->id)->first();
        $attendances = AttendanceListStudent::where('attendance_list_detail_id', $ad->id)->get();


        return view('student.m_lecturer_document.m_absensi', compact('al', 'ad', 'student_classes', 'attendance', 'attendances'));
    }
    public function storeStudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_list_detail_id' => 'required|exists:attendance_list_details,id',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.attendance_student' => 'required|in:1,2,3,4,5',
            'attendance.*.minutes_late' => 'nullable|integer|min:1|required_if:attendance.*.attendance_student,2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            
            DB::beginTransaction();

            $attendanceListDetailId = $request->input('attendance_list_detail_id');

            $dhDetail = AttendanceListDetail::where('id', $attendanceListDetailId )->first();

            $dh = AttendanceList::where('id', $dhDetail->attendance_list_id)->first();

            $attendances = $request->input('attendance');

            foreach ($attendances as $attendance) {
                AttendanceListStudent::updateOrCreate(
                    [
                        'attendance_list_detail_id' => $attendanceListDetailId,
                        'student_id' => $attendance['student_id'],
                    ],
                    [
                        'attendance_student' => $attendance['attendance_student'],
                        'minutes_late' => $attendance['minutes_late'] ?? null,
                        'note' => $attendance['note'] ?? null,
                    ],
                );
            }

            $sumAttendance = AttendanceListStudent::where('attendance_list_detail_id', $attendanceListDetailId)
                ->whereIn('attendance_student', [1, 2])
                ->count();
            $sumLateAttendance = AttendanceListStudent::where('attendance_list_detail_id', $attendanceListDetailId)
                ->whereIn('attendance_student', [2])
                ->count();

            AttendanceListDetail::where('id', $attendanceListDetailId)->update([
                'sum_attendance_students' => $sumAttendance,
                'sum_late_students' => $sumLateAttendance,
                'has_acc_lecturer' => 1,
            ]);
            JournalDetail::where('id', $attendanceListDetailId)->update([
                'sum_attendance_students' => $sumAttendance,
                'sum_late_students' => $sumLateAttendance,
                'has_acc_lecturer' => 1,
            ]);

            DB::commit();
            return redirect()->route('student.lecturer_document.m_details', $dh->id)->with('success', 'Daftar Hadir dan Jurnal Detail Berhasil Di simpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'An error occurred while saving student attendance: ' . $e->getMessage());
        }
    }

    public function edit_student(string $id)
    {
        $ad = AttendanceListDetail::find($id);

        $al = AttendanceList::find($ad->attendance_list_id);

        $student_classes = Student::where('student_class_id', $al->student_class_id)->get();

        $attendances = AttendanceListStudent::where('attendance_list_detail_id', $ad->id)->get();

        $student_classes = $student_classes->map(function ($student) use ($attendances) {
            $attendance = $attendances->firstWhere('student_id', $student->id);
            $student->attendance_student = $attendance->attendance_student ?? null;
            $student->minutes_late = $attendance->minutes_late ?? null;
            $student->note = $attendance->note ?? null;
    
            return $student;
        });
        return view('student.m_lecturer_document.m_edit_student', compact('al', 'ad', 'student_classes', 'attendances'));
    }

    public function update_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_list_detail_id' => 'required|exists:attendance_list_details,id',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.attendance_student' => 'required|in:1,2,3,4,5',
            'attendance.*.minutes_late' => 'nullable|integer|min:1|required_if:attendance.*.attendance_student,2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            
            DB::beginTransaction();

            $attendanceListDetailId = $request->input('attendance_list_detail_id');
            $dhDetail = AttendanceListDetail::where('id', $attendanceListDetailId )->first();

            $dh = AttendanceList::where('id', $dhDetail->attendance_list_id)->first();

            $attendances = $request->input('attendance');

            foreach ($attendances as $attendance) {
                AttendanceListStudent::updateOrCreate(
                    [
                        'attendance_list_detail_id' => $attendanceListDetailId,
                        'student_id' => $attendance['student_id'],
                    ],
                    [
                        'attendance_student' => $attendance['attendance_student'],
                        'minutes_late' => $attendance['minutes_late'] ?? null,
                        'note' => $attendance['note'] ?? null,
                    ],
                );
            }

            $sumAttendance = AttendanceListStudent::where('attendance_list_detail_id', $attendanceListDetailId)
                ->whereIn('attendance_student', [1, 2])
                ->count();
                $sumLateAttendance = AttendanceListStudent::where('attendance_list_detail_id', $attendanceListDetailId)
                ->whereIn('attendance_student', [2])
                ->count();

            AttendanceListDetail::where('id', $attendanceListDetailId)->update([
                'sum_attendance_students' => $sumAttendance,
                'sum_late_students' => $sumLateAttendance,
                'has_acc_lecturer' => 1,
            ]);

            JournalDetail::where('id', $attendanceListDetailId)->update([
                'sum_attendance_students' => $sumAttendance,
                'sum_late_students' => $sumLateAttendance,
                'has_acc_lecturer' => 1,
            ]);

            DB::commit();
            return redirect()->route('student.lecturer_document.m_details',  $dh->id)->with('success', 'Daftar Hadir dan Jurnal Detail Berhasil Di simpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'An error occurred while saving student attendance: ' . $e->getMessage());
        }
    }

    public function index2(Request $request, string $nidn)
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

        return view('student.m_lecturer_document.m_index_daftar', compact('user', 'data'));
    }

    public function verifikasi($id)
    {
        $al_detail = AttendanceListDetail::find($id);
        DB::beginTransaction();
        try{
            
            $user = Auth::user();
            $al_detail->has_acc_student = 1;
            $al_detail->student_id = $user->student->id;
            $al_detail->save();
            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Data Berhasil Di Verifikasi!');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Error Saat Verifikasi: ' . $e->getMessage());
        }
    }
}
