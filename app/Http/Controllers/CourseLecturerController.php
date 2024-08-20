<?php

namespace App\Http\Controllers;

use App\Models\CourseLecturer;
use App\Models\Courses;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseLecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lecturer $lecturer)
    {
        $courses = Courses::all();
        return view('masterdata.course_lecturer.create', compact('lecturer', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lecturer $lecturer)
    {
        // dd($request->all());
        $validated= $request->validate([
            'course_id'=> 'required|integer|max:255',
        ]);
        
        DB::beginTransaction();
        try{
            
            $validated['lecturer_id']=$lecturer->id;
            $assignCouses = CourseLecturer::updateOrCreate($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Courses Assigned Succesfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseLecturer $courseLecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLecturer $courseLecturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLecturer $courseLecturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLecturer $courseLecturer)
    {
        
        try{
            $courseLecturer->delete();
            return redirect()->back()->with('success','Course deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }
}
