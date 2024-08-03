<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lecturer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.lecturer.create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = $lecturer->user;

        // DB::transaction(function() use ($fundraiser, $user){
            
        //     if(!$user->hasRole('fundraiser')){
        //         $user->assignRole('fundraiser');
        //     }
        // });
        // return redirect()->route('admin.fundraisers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        //
    }
}
