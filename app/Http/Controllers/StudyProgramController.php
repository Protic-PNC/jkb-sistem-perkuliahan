<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudyProgram::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('jenjang', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->paginate(5);
        return view('masterdata.study_programs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.study_programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'jenjang'=>'required|string|in:D3,D4',
        ]);
        DB::beginTransaction();
        try{
            $newProdi= StudyProgram::create($validated);
            DB::commit();
            return redirect()->route('masterdata.study_programs.index')->with('success', 'Program Studi Berhasil Disimpan');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyProgram $study_program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $study_program)
    {
        return view('masterdata.study_programs.edit', [
            'study_program'=> $study_program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $study_program)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'jenjang'=>'required|string|in:D3,D4',
        ]);
        DB::beginTransaction();
        try{
            $study_program->update($validated);
            DB::commit();
            return redirect()->route('masterdata.study_programs.index')->with('success', 'Program Studi Berhasil Diedit');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $study_program)
    {
        try{
            $study_program->delete();
            return redirect()->back()->with('success','Projects deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
