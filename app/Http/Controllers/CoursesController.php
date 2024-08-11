<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Courses::all();
        return view('masterdata.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('masterdata.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'type' => 'required|string',
            'sks' => 'required|integer',
            'hours' => 'required|integer',
        ]);
            $hoursPerSKS = 16; // 16 jam per SKS
            $totalHours = $validated['sks'] * $hoursPerSKS;
            
            $meeting = ceil($totalHours / $validated['hours']); // Pembulatan ke atas
            // Tambahkan meeting ke data yang akan disimpan
            $validated['meeting'] = $meeting;
            
        try {
            DB::beginTransaction();
            // Buat record baru
            $newMatkul = Courses::create($validated);
            
            DB::commit();
            return redirect()->route('masterdata.courses.index')->with('success', 'Mata Kuliah Berhasil Disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $course)
    {
        return view('masterdata.courses.edit', [
            'course'=> $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $course)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'type' => 'required|string',
            'sks' => 'required|integer',
            'hours' => 'required|integer',
        ]);
            $hoursPerSKS = 16; // 16 jam per SKS
            $totalHours = $validated['sks'] * $hoursPerSKS;
            $meeting = ceil($totalHours / $validated['hours']); // Pembulatan ke atas
            // Tambahkan meeting ke data yang akan disimpan
            $validated['meeting'] = $meeting;
            DB::beginTransaction();
        try {
            // Buat record baru
            $course->update($validated);
            
            DB::commit();
            return redirect()->route('masterdata.courses.index')->with('success', 'Mata Kuliah Berhasil Diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $course)
    {
        try{
            $course->delete();
            return redirect()->back()->with('succes','Course deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
