<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\Courses;
use App\Models\Journal;
use App\Models\Lecturer;
use App\Models\Periode;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class A_Lecturer_DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attendanceLists = AttendanceList::with('student_class', 'course', 'lecturer','attendanceListDetails')->orderBy('id','desc');

// Jika ada parameter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');

            $attendanceLists->where(function ($q) use ($search) {
                $q->whereHas('student_class.study_program', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('course', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('lecturer', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        
        // Gunakan paginate untuk paginasi hasil query
        $data = $attendanceLists->paginate(10);
        
        // Return ke view dengan data yang dipaginasi
        return view('masterdata.a_lecturer_document.index', compact('data'));
        
    }
    public function daftar_index(Request $request)
    {
        $attendanceLists = AttendanceList::with('student_class', 'course', 'lecturer','attendanceListDetails')->orderBy('id','desc');


        if ($request->has('search')) {
            $search = $request->input('search');

            $attendanceLists->where(function ($q) use ($search) {
                $q->whereHas('student_class.study_program', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('course', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('lecturer', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        
        
        if (Auth::user()->hasRole("dosen")) {
            $data = $attendanceLists->where('lecturer_id', Auth::user()->lecturer->id)->paginate(5);
        } else {

            $data = $attendanceLists->paginate(5);
        }
        
        return view('masterdata.a_lecturer_document.daftar_index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student_classes = StudentClass::get();
        $periode = Periode::get();
        return view('masterdata.a_lecturer_document.create', compact('student_classes', 'periode'));
    }

    public function getCoursesByClass($classId)
    {
        $courses = DB::table('courses')->join('course_classes', 'courses.id', '=', 'course_classes.course_id')->where('course_classes.student_class_id', $classId)->select('courses.id', 'courses.name')->get();

        return response()->json($courses);
    }
    public function getLecturerByClass($courseId)
    {
        
        $lecturers = Lecturer::whereHas('courseLecturers', function($query) use ($courseId) {
                        $query->where('course_id', $courseId);
                    })
                    ->select('id', 'name')
                    ->get();
        
        return response()->json($lecturers);
    }
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'student_class_id' => 'required|exists:student_classes,id',
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'periode_id' => 'required|exists:periodes,id',
        ]);
        DB::beginTransaction();
        try {
            Log::info('Database transaction started.');

            
            $existingAttendance = AttendanceList::where('course_id', $request->course_id)
                ->where('lecturer_id', $request->lecturer_id)
                ->where('student_class_id', $request->student_class_id)
                ->first();
                // if ($existingAttendance) {
                //     return redirect()->back()->with([
                //         'status' => 'error',
                //         'message' => 'Dokumen Sudah Pernah Dibuat, Silahkan buat variasi dokumen yang baru'
                //     ]);

                // }
            if ($existingAttendance) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dokumen Sudah Pernah Dibuat, Silahkan buat variasi dokumen yang baru'
                ], 422);
            }
            $al = new AttendanceList();
            $al->code_al = Str::uuid()->toString();
            $al->student_class_id = $request->student_class_id;
            $al->course_id = $request->course_id;
            $al->lecturer_id = $request->lecturer_id;
            $al->periode_id = $request->periode_id;
            $al->save();
            $journal = new Journal();
            $journal->attendance_list_id = $al->id;
            $journal->save();
            DB::commit();
            Log::info('Database transaction committed.');
            return response()->json([
                'status' => 'success',
                'message' => 'Daftar Hadir dan Jurnal berhasil disimpan'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Database transaction rolled back due to exception: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $lecturer_document = AttendanceList::findOrFail($id);
        $periode = Periode::get();
        $student_classes = StudentClass::all();
        return view('masterdata.a_lecturer_document.edit', compact('lecturer_document', 'student_classes', 'periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    

public function update(Request $request, $id)
{
    // Find the AttendanceList
    $attendanceList = AttendanceList::findOrFail($id);

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'student_class_id' => 'required|exists:student_classes,id',
        'course_id' => 'required|exists:courses,id',
        'lecturer_id' => 'required|exists:lecturers,id',
        'periode_id' => 'required|exists:periodes,id',
    ]);

    if ($validator->fails()) {
        return redirect()->route('dokumen_perkuliahan.kelola.edit', $id)
            ->withErrors($validator)
            ->withInput();
    }

    // Update the AttendanceList
    $attendanceList->update([
        'student_class_id' => $request->student_class_id,
        'course_id' => $request->course_id,
        'lecturer_id' => $request->lecturer_id,
        'periode_id' => $request->periode_id,
    ]);

    // Redirect with success message
        return redirect()->route('dokumen_perkuliahan.kelola.index')
            ->with('success', 'Daftar Hadir berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $al = AttendanceList::find($id);
        try{
            $al->delete();
            return redirect()->back()->with('success','Dokumen Perkuliahan Berhasil Dihapus');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('errors', 'System eror'.$e->getMessage());
        }
    }

    public function absensi_perkuliahan($id)
    {
        $data = AttendanceList::findOrFail($id);

        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();

        $students = $student_class->students;
        $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->with('attendenceList')
            ->orderBy('meeting_order')
            ->get();
  
        return view('masterdata.a_lecturer_document.absensi_index', compact('data',  'students','attendencedetail'));
    }
    public function jurnal_perkuliahan($id)
    {
        $data = AttendanceList::findOrFail($id);
        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();
            $semester = $data->student_class->calculateSemester();
            $academicYear = $student_class->calculateAcademicYear($semester);

            $students = $student_class->students;

            $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->orderBy('meeting_order', 'asc')->get();

        return view('masterdata.a_lecturer_document.jurnal_index', compact('data', 'semester', 'academicYear', 'students','attendencedetail'));
    }

    
}
