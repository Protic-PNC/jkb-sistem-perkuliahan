<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\Courses;
use App\Models\Journal;
use App\Models\Lecturer;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class A_Lecturer_DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attendanceLists = AttendanceList::with('student_class', 'course', 'lecturer');
        
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
        return view('masterdata.a_lecturer_document.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student_classes = StudentClass::get();
        return view('masterdata.a_lecturer_document.create', compact('student_classes'));
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
        $validator = Validator::make($request->all(), [
            'code_al' => 'required|string|unique:attendance_lists,code_al',
            'student_class_id' => 'required|exists:student_classes,id',
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Log::error('Validation failed: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            Log::info('Database transaction started.');

            // Cek apakah kombinasi course_id dan lecturer_id sudah ada
            $existingAttendance = AttendanceList::where('course_id', $request->course_id)
                ->where('lecturer_id', $request->lecturer_id)
                ->where('student_class_id', $request->student_class_id)
                ->first();

            if ($existingAttendance) {
                Log::warning('Duplicate attendance entry detected: course_id = ' . $request->course_id . ', lecturer_id = ' . $request->lecturer_id);
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
            Log::info('AttendanceList saved successfully.');

            // Simpan data Journal
            $journal = new Journal();
            $journal->attendance_list_id = $al->id;
            $journal->save();
            Log::info('Journal saved successfully.');

            DB::commit();
            Log::info('Database transaction committed.');
            return redirect()->route('masterdata.lecturer_documents.index')->with('success', 'Daftar Hadir dan Jurnal berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Database transaction rolled back due to exception: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'System error: ' . $e->getMessage());
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
        $lecturer_document = AttendanceList::findOrFail($id);
    $student_classes = StudentClass::all();
    return view('masterdata.a_lecturer_document.edit', compact('lecturer_document', 'student_classes'));
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
        'code_al' => 'required|string|unique:attendance_lists,code_al,' . $id,
        'student_class_id' => 'required|exists:student_classes,id',
        'course_id' => 'required|exists:courses,id',
        'lecturer_id' => 'required|exists:lecturers,id',
    ]);

    if ($validator->fails()) {
        return redirect()->route('masterdata.lecturer_documents.edit', $id)
            ->withErrors($validator)
            ->withInput();
    }

    // Update the AttendanceList
    $attendanceList->update([
        'code_al' => $request->code_al,
        'student_class_id' => $request->student_class_id,
        'course_id' => $request->course_id,
        'lecturer_id' => $request->lecturer_id,
    ]);

    // Redirect with success message
        return redirect()->route('masterdata.lecturer_documents.index')
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
            return redirect()->back()->with('success','Course deleted sussesfully');
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
            $semester = $data->student_class->calculateSemester();
            $academicYear = $student_class->calculateAcademicYear($semester);

            $students = $student_class->students;

            $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)->get();

        return view('masterdata.a_lecturer_document.absensi_index', compact('data', 'semester', 'academicYear', 'students','attendencedetail'));
    }
    public function jurnal_perkuliahan()
    {

    }
}
