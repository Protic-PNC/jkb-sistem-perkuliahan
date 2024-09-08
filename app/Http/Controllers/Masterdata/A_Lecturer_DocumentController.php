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
    public function index()
    {
        return view('masterdata.lecturer_document.index');
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
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
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
