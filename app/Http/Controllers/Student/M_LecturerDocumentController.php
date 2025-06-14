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

        $attendanceLists = AttendanceList::select('attendance_lists.id', 'attendance_lists.student_class_id', 'attendance_lists.course_id')->where('student_class_id', $user->student->student_class_id)->orderBy('id','desc');

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
    public function riwayat_absensi(Request $request, string $nim)
    {
        $user = Auth::user();
        $student = Student::where('nim', $nim)->firstOrFail();

        // Ambil semua daftar absensi untuk mahasiswa ini
        $data = AttendanceList::with(['course', 'attendanceListDetails.attendence_list_student'])
            ->whereHas('attendanceListDetails.attendence_list_student', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->get()
            ->map(function ($item) use ($student) {
                // Ambil semua detail absensi untuk mahasiswa ini saja
                $details = $item->attendanceListDetails
                    ->flatMap(function ($detail) use ($student) {
                        return $detail->attendence_list_student
                            ->where('student_id', $student->id);
                    });

                $jumlahHadir = $details->where('attendance_student', 1)->count();
                $jumlahTerlambat = $details->where('attendance_student', 2)->count();
                $jumlahSakit = $details->where('attendance_student', 3)->count();
                $jumlahIzin = $details->where('attendance_student', 4)->count();
                $jumlahBolos = $details->where('attendance_student', 5)->count();

                $total = $jumlahHadir + $jumlahTerlambat + $jumlahSakit + $jumlahIzin + $jumlahBolos;
                $persentase = $total > 0 ? round(($jumlahHadir / $total) * 100, 2) : 0;

                $item->jumlah_hadir = $jumlahHadir;
                $item->jumlah_terlambat = $jumlahTerlambat;
                $item->jumlah_sakit = $jumlahSakit;
                $item->jumlah_izin = $jumlahIzin;
                $item->jumlah_bolos = $jumlahBolos;
                $item->persentase = $persentase;

                return $item;
            });

        return view('student.m_lecturer_document.m_riwayat_index', compact('user', 'data', 'student'));
    }



    public function details($id)
    {
        // $data = AttendanceList::findOrFail($id);

        // $details= AttendanceListDetail::where('attendance_list_id', $data->id)
        // ->get();
        
        // $student_class = StudentClass::with(['students', 'course'])
        //     ->where('id', $data->student_class_id)
        //     ->firstOrFail();
        // $semester = $data->student_class->calculateSemester();
        // $academicYear = $student_class->calculateAcademicYear($semester);

        // $students = $student_class->students;

        // $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->first();

        // return view('student.m_lecturer_document.m_details', compact( 'data', 'details','semester', 'academicYear', 'students'));
        $data = AttendanceList::findOrFail($id);

        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();

        $students = $student_class->students;


        $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)
            ->orderBy('meeting_order')
            ->get();

        return view('student.m_lecturer_document.m_details', compact( 'data', 'attendencedetail', 'students'));
    }
    public function detail_verifikasi($id)
    {
        $details= AttendanceListDetail::findOrFail($id);
        $data = AttendanceList::where('id', $details->attendance_list_id)->first();

        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();

        $students = $student_class->students;

        return view('student.m_lecturer_document.m_detail_verifikasi', compact( 'data', 'details', 'students'));
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
        $journaldetail = JournalDetail::where('attendance_list_detail_id', $al_detail->id)->first();
        DB::beginTransaction();
        try{
            
            $user = Auth::user();
            $al_detail->has_acc_student = 2;
            $al_detail->date_acc_student = now();
            $al_detail->student_id = $user->student->id;
            $al_detail->save();
            $journaldetail->has_acc_student = 2;
            $journaldetail->date_acc_student = now();
            $journaldetail->student_id = $user->student->id;
            $journaldetail->save();
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
