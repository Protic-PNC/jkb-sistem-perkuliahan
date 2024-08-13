<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('academic_year', 'LIKE', "%{$search}%");
            });
        }
        $data = $query->with('study_program')->orderBy('academic_year', 'asc')->paginate(5);
        
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'academic_year' => 'required|integer',
            'study_program_id' => 'required|integer',
        ]);

        $existing = StudentClass::where('academic_year', $validated['academic_year'])
            ->where('study_program_id', $validated['study_program_id'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Data with the same academic year and study program already exists.');
        }

        DB::beginTransaction();
        try {
            $newKelas = StudentClass::create($validated);
            DB::commit();
            return redirect()->route('masterdata.student_classes.index')->with('succes', 'Kelas Berhasil Disimpan');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'System eror' . $e->getMessage());
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
            'study_program_id' => 'required|integer',
        ]);

        $existing = StudentClass::where('academic_year', $validated['academic_year'])
            ->where('study_program_id', $validated['study_program_id'])
            ->first();
            

        if ($existing) {
            return redirect()->back()->with('error', 'Data with the same academic year and study program already exists.');
        }
        try{
            $student_class->update($validated);
            DB::commit();
            return redirect()->route('masterdata.student_class.index')->with('succes', 'Kelas Berhasil Diedit');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClass $student_class)
    {
        try{
            $student_class->delete();
            return redirect()->back()->with('succes','Projects deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
