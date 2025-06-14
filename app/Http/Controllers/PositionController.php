<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Position::query()->orderBy('id','desc');
        
        $data = $query->with('prodis')->paginate(5);  
        return view('masterdata.positions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = StudyProgram::all();
        return view('masterdata.positions.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'prodi_id'=>'nullable|exists:study_programs,id'
        ]);
        DB::beginTransaction();
        try{
            $p = new Position();
            $p->name = $request->name;
            $p->prodi_id = $request->prodi_id;
            $p->save();
            DB::commit();
            return redirect()->route('masterdata.positions.index')->with('success', 'Position Berhasil Disimpan');
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
        $prodis = StudyProgram::all(); // pastikan data prodi tersedia
        return view('masterdata.positions.edit', [
            'position' => $position,
            'prodis' => $prodis,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'prodi_id'=>'nullable|exists:study_programs,id'
            
        ]);
        DB::beginTransaction();
        try{
            $position->update($validated);
            DB::commit();
            return redirect()->route('masterdata.positions.index')->with('success', 'Program Studi Berhasil Disimpan');
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
            return redirect()->back()->with('success','Jabatan Berhasil Dihapus');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
