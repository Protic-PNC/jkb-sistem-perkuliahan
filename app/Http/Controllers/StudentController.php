<?php

namespace App\Http\Controllers;

use App\Imports\Masterdata\StudentImport;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query
                ->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")->orWhere('nim', 'LIKE', "%{$search}%");
                })
                ->orWhere(function ($q) use ($search) {
                    $q->where('number_phone', 'LIKE', "%{$search}%");
                })
                ->orWhere(function ($q) use ($search) {
                    $q->where('address', 'LIKE', "%{$search}%");
                });
        }

        $students = $query->paginate(5);

        return view('masterdata.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $student_class = StudentClass::all();
        $user = User::find($userId);

        $existingStudent = Student::where('user_id', $userId)->first();
        if ($existingStudent) {
            return redirect()->route('masterdata.students.show', $existingStudent->id);
        } else {
            return view('masterdata.students.create', compact('student_class', 'user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string|unique:students,nim',
            'address' => 'required|string',
            'number_phone' => 'required|string',
            'student_class_id' => 'required|exists:student_classes,id',
            'user_id' => 'required|exists:users,id',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        try {
            DB::beginTransaction();

            // Menyimpan signature jika ada
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }

            // Membuat student dengan data yang sudah divalidasi
            $student = Student::create($validated);

            DB::commit();
            return redirect()->route('masterdata.students.show')->with('success', 'User Mahasiswa berhasil disimpan');
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
    public function show(Student $student, $id)
    {
        $student_class = StudentClass::all();
        $student = Student::find($id);
        return view('masterdata.students.show', compact('student_class', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, $id)
    {
        $student_class = StudentClass::all();
        $student = Student::find($id);

        return view('masterdata.students.edit', compact('student_class', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'nim' => [
                'required',
                'string',
                Rule::unique('students', 'nim')
                    ->ignore($student->id)
                    ->whereNull('deleted_at'),
            ],
            'address' => 'required|string',
            'number_phone' => 'required|string',
            'student_class_id' => 'required|exists:student_classes,id',
            'user_id' => ['required', Rule::exists('users', 'id')],
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $validated['signature'] = $signaturePath;
        }
        DB::beginTransaction();
        try {
            $student->update($validated);

            DB::commit();
            return redirect()->route('masterdata.students.index')->with('success', 'User Mahasiswa berhasil Diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
    public function import(Request $request)
    {
     
        $request->validate([
            'file' => 'required|file|max:2048|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');
       
        $signaturePath = $file->store('import_students', 'public');
        
       
        Excel::import(new StudentImport(), $file);

        // Cek apakah file berhasil disimpan di S3 dan kirim respon
        if ($signaturePath) {
            return response()->json(['success' => true, 'message' => 'File imported successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Import Failed!'], 500);
        }
    }
}
