<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students= Student::all();
        return view('masterdata.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $student_class = StudentClass::all();

        $user = User::find($userId);
        
        return view('masterdata.students.create', compact('student_class', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string|unique:students,nim',
            'address' => 'required|string',
            'number_phone' => 'required|string',
            'student_class_id' => 'required|exists:student_classes,id',
            'user_id' => 'required|exists:users,id',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $data['signature'] = $signaturePath;
        }
        try {
            DB::beginTransaction();
            $data = $validated;
            $student = Student::create($data);
    
            DB::commit();
            return redirect()->route('masterdata.users.index')->with('success', 'User Mahasiswa berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
