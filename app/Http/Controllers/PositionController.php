<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Position::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->paginate(5);
        return view('masterdata.positions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.positions.create');
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
            $newJabatan= Position::create($validated);
            DB::commit();
            return redirect()->route('masterdata.positions.index')->with('succes', 'Position Berhasil Disimpan');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('masterdata.positions.edit', [
            'position'=> $position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            
        ]);
        DB::beginTransaction();
        try{
            $position->update($validated);
            DB::commit();
            return redirect()->route('masterdata.positions.index')->with('succes', 'Program Studi Berhasil Disimpan');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        try{
            $position->delete();
            return redirect()->back()->with('succes','Position deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
