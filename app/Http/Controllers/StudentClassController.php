<?php

namespace App\Http\Controllers;

use App\Exports\Masterdata\Student_ClassExport;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentClass::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")->orWhere('academic_year', 'LIKE', "%{$search}%");
            });
        }
        $data = $query->with('study_program')->orderBy('academic_year', 'asc')->paginate(5);  
       
        $currentDate = Carbon::now();    
        $currentYear = $currentDate->year;    
        $currentMonth = $currentDate->month;    
        
        foreach ($data as $item) {    
            $classNumber = '';    
            $academicYear = $item->academic_year;    
        
            Log::info("Current Year: $currentYear, Academic Year: $academicYear");    
        
            if ($currentYear == $academicYear) {  
                 
                if ($currentMonth <= 8) {  
                    $classNumber = $currentYear - $academicYear; 
                } else {  
                    $classNumber = $currentYear - $academicYear + 1;  
                }  
            } elseif ($currentYear !== $academicYear ) {  
                if ($currentMonth <= 8) {  
                    $classNumber = $currentYear - $academicYear;  
                } else {  
                    $classNumber = $currentYear - $academicYear + 1;  
                }  
            } else {  
                $classNumber = ''; 
            }  

            $item->level = $classNumber;
            $item->save();
          
        }    

  
        return view('masterdata.student_class.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = StudyProgram::all();
        return view('masterdata.student_class.create', compact('prodis'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_year' => 'required|integer',
           'study_program_id' => 'required|exists:study_programs,id',
        ]);

        DB::beginTransaction();
        try {
            
            $prodi = StudyProgram::where('id', $request->study_program_id)->first();
            $sc = new StudentClass();
            $sc->name = $request->input('name');
            $sc->academic_year = $request->input('academic_year');
            $sc->study_program_id = $request->input('study_program_id');
            $sc->status = 1;
            $sc->code = $prodi->brief . $request->input('name') . $request->input('academic_year');
            $sc->save();

            DB::commit();
            return redirect()->route('masterdata.student_classes.index')->with('success', 'Kelas Berhasil Disimpan');
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
    public function show(StudentClass $studentClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClass $student_class)
    {
        $prodis = StudyProgram::all();
        return view('masterdata.student_class.edit', compact('student_class', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentClass $student_class)
    {
        
        $validated = $request->validate([
           'name' => 'required|string|max:255',
            'academic_year' => 'required|integer',
           'study_program_id' => 'required|exists:study_programs,id',
        ]);

        DB::beginTransaction();
        try {
            $prodi = StudyProgram::where('id', $request->study_program_id)->first();
            $student_class->name = $request->input('name');
            $student_class->academic_year = $request->input('academic_year');
            $student_class->study_program_id = $request->input('study_program_id');
            $student_class->status = 1;
            $student_class->code = $prodi->brief . $request->input('name') . $request->input('academic_year');
            $student_class->save();
            DB::commit();
            return redirect()->route('masterdata.student_classes.index')->with('success', 'Kelas Berhasil Diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'System eror' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClass $student_class)
    {
        try {
            $student_class->delete();
            return redirect()->back()->with('success', 'Projects deleted sussesfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'System eror' . $e->getMessage());
        }
    }

    public function export() 
    {
        return Excel::download(new Student_ClassExport, 'Daftar Kelas.xlsx');
    }
}
