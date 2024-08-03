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
    public function index()
    {
        $prodis = StudyProgram::all();
        return view('admin.study_programs.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.study_programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        DB::beginTransaction();
        try{
            $newProdi= StudyProgram::create($validated);
            DB::commit();
            return redirect()->route('admin.study_programs.index')->with('succes', 'Program Studi Berhasil Disimpan');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        //
    }
}
