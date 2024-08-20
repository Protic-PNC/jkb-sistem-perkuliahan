<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\LecturerPosition;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerPositionController extends Controller
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
        
        $positions = Position::all();
        return view('masterdata.lecturer_position.create', compact('lecturer', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lecturer $lecturer)
    {
        $validated= $request->validate([
            'position_id'=> 'required|integer|max:255',
        ]);
        
        DB::beginTransaction();
        try{
            
            $validated['lecturer_id']=$lecturer->id;
            $assignCouses = LecturerPosition::updateOrCreate($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Lecturer Position Assigned Succesfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LecturerPosition $lecturerPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LecturerPosition $lecturerPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LecturerPosition $lecturerPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LecturerPosition $lecturer_position)
    {
        try{
            $lecturer_position->delete();
            return redirect()->back()->with('success','Position deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error'.$e->getMessage());
        }
    }
}
