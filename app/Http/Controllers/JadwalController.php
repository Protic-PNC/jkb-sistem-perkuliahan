<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $data = StudyProgram::with('jadwal')->select('id','name')->get();

        
        return view('masterdata.jadwal_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       Log::info( 'id : '. $id);
       $prodi = StudyProgram::findOrFail($id);
       Log::info( 'prodi : '. $prodi);
       return response()->json(['prodi' => $prodi], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'file_jadwal' => 'required|file|mimes:xlsx,csv,xls|max:10240', // Max 10MB
    ]);

    // Simpan file ke storage/app/public/file_jadwal
    $file = $request->file('file_jadwal');
    $filename = time() . '-' . $file->getClientOriginalName();
    $path = $file->storeAs('file_jadwal', $filename, 'public'); // Simpan di storage/app/public/file_jadwal

    // Simpan path ke database
    $jadwal = Jadwal::updateOrCreate(
        ['prodi_id' => $id],
        ['file' => $filename] // Hanya simpan nama file, bukan full path
    );

    return response()->json([
        'success' => true,
        'message' => 'File berhasil diupload',
        'file_url' => asset("storage/file_jadwal/{$filename}") // Generate URL publik
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
    public function download($id)
    {
        // 1. Cari data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // 2. Verifikasi file exist
        $filePath = storage_path('app/public/file_jadwal/' . $jadwal->file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        // 3. Tentukan header untuk response download
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        // 4. Return response download
        return response()->download($filePath, $jadwal->file, $headers);
    }
}
