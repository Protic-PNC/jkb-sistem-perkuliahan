<?php

namespace App\Http\Controllers;

use App\Imports\Masterdata\StudentImport;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use App\Rules\ExcelFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

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

        $students = $query->with('student_class', 'student_class.study_program')->paginate(5);

        return view('masterdata.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student_class = StudentClass::all();
        // $user = User::find($userId);

        // $existingStudent = Student::where('user_id', $userId)->first();
        return view('masterdata.students.create', compact('student_class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'nim' => 'required|string|unique:students,nim',
                'address' => 'required|string',
                'number_phone' => 'required|string',
                'signature' => 'required|image|mimes:png,jpg,jpeg',
                'student_class_id' => 'required|exists:student_classes,id',
            ]);

            
            $user = User::create([
                'name' => $request->nim,
                'avatar' => null,
                'email' => $request->nim . '@pnc.ac.id',
                'password' => Hash::make($request->nim),
            ]);
            $user->assignRole('mahasiswa');
            $validated['user_id'] = $user->id;
            $signature = $request->file('signature');
            $signatureFilename = null;
            if ($signature) {
                $signatureFilename = date('Ymd') . time() . '-' . $signature->getClientOriginalName();
                Storage::disk('google')->putFileAs(
                    'signatures',
                    $request->file('signatures'),
                    $signatureFilename
                );
            }
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }
            Student::create($validated);
            return redirect()->route('masterdata.students.index')->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'System error: ' . $e->getMessage()]);
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
            'signature' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        DB::beginTransaction();
       
        try {
            
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }
            $student = Student::updateOrCreate(
                ['id' => $student->id], 
                $validated 
            );
            $data = [
                'name' => $validated['nim'],
                'email' => $validated['nim']. '@pnc.ac.id',
                'password' => Hash::make($request->nim),
            ];
            // dd($userall);
            $user = User::where('id', $student->user_id)->first();
            $user->update($data);
            DB::commit();
            return redirect()->route('masterdata.students.index')->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            Log::error('System error: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try{
            $student->delete();
            return redirect()->back()->with('success','Mahasiswa deleted sussesfully');
        }
        catch(Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
    public function import(Request $request)
    {
     
        
       DB::beginTransaction();
       try {
        $request->validate([
            'file' => ['required', 'max:2048', new ExcelFile()],
        ]);
        
        $file = $request->file('file');
        $filename = time() . '-' . $file->getClientOriginalName();
    
        $store = $file->store('import_students', 'public');
        Log::info('File uploaded: ' . $filename);
    
        Excel::import(new StudentImport(), $file);
        
        return response()->json(['success' => true, 'message' => 'File imported successfully'], 200);
    } catch (Exception $e) {
        Log::error('Import Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    
    }
}
