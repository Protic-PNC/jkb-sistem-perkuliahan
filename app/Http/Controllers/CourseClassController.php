<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use App\Models\Courses;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseClassController extends Controller
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
    public function create(StudentClass $student_class)
    {
        $courses = Courses::all();
        return view('masterdata.course_class.create', compact('student_class', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StudentClass $student_class)
    {
        // dd($request->all());
        $validated= $request->validate([
            'course_id'=> 'required|integer|max:255',
        ]);
        
        DB::beginTransaction();
        try{
            
            $validated['student_class_id']=$student_class->id;
            $assignCourses = CourseClass::updateOrCreate($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Course Class Assigned Succesfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseClass $courseClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseClass $courseClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseClass $courseClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseClass $course_class)
    {
        try{
            $course_class->delete();
            return redirect()->back()->with('success','Course Class deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }
}
