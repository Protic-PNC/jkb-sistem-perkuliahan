<?php

namespace App\Http\Controllers\Masterdata;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendenceList;
use App\Models\Journal;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class A_Lecturer_DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        
        // Return ke view dengan data yang dipaginasi
        return view('masterdata.lecturer_document.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student_classes = StudentClass::get();
        return view('masterdata.lecturer_document.create', compact('student_classes'));
    }

    public function getCoursesByClass($classId)
    {
        $courses = DB::table('courses')->join('course_classes', 'courses.id', '=', 'course_classes.course_id')->where('course_classes.student_class_id', $classId)->select('courses.id', 'courses.name')->get();

        return response()->json($courses);
    }
    public function getLecturerByClass($courseId)
    {
        $lecturers = DB::table('lecturers')->join('course_lecturers', 'lecturers.id', '=', 'course_lecturers.lecturer_id')->where('course_lecturers.course_id', $courseId)->select('lecturers.id', 'lecturers.name')->get();

        return response()->json($lecturers);
    }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'code_al' => 'required|string|unique:attendance_lists,code_al',
            'student_class_id' => 'required|exists:student_classes,id',
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Cek apakah kombinasi course_id dan lecturer_id sudah ada
            $existingAttendance = AttendanceList::where('course_id', $request->course_id)
                ->where('lecturer_id', $request->lecturer_id)
                ->first();

            if ($existingAttendance) {
                // Jika kombinasi course_id dan lecturer_id sudah ada, kembalikan pesan error
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['error' => 'Kombinasi Mata Kuliah dan Dosen sudah ada dalam daftar hadir.']);
            }

            // Simpan data AttendanceList
            $al = new AttendanceList();
            $al->code_al = $request->code_al;
            $al->student_class_id = $request->student_class_id;
            $al->course_id = $request->course_id;
            $al->lecturer_id = $request->lecturer_id;
            $al->save();

            // Simpan data Journal
            $journal = new Journal();
            $journal->student_class_id = $request->student_class_id;
            $journal->course_id = $request->course_id;
            $journal->lecturer_id = $request->lecturer_id;
            $journal->save();

            DB::commit();
            return redirect()->route('masterdata.lecturer_document.index')->with('success', 'Daftar Hadir dan Jurnal berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
