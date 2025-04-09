<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Periode::all();

        foreach ($data as $periode) {
            $batasAkhir = Carbon::createFromFormat('Y-m-d', $periode->tanggal_batas_akhir);
            $batasAwal = Carbon::createFromFormat('Y-m-d', $periode->tanggal_batas_awal);
            if (now()->greaterThan($batasAkhir) && $periode->status == 1) {
                $periode->status = 0;
                $periode->save();
            }
        }
        return view('masterdata.periode_index', compact('data'));
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
        Log::info('Membuat periode baru');
        // dd($request->all());
        $data = request()->validate([
            'tahun' => 'required|integer',
            'tanggal_batas_awal' => 'required|date',
            'tanggal_batas_akhir' => 'required|date',
            'semester' => 'required|string|max:10',
        ]);
        $data['tahun_akademik'] = $data['tahun'] . '/' . ($data['tahun'] + 1);
        
        $data['tanggal_batas_awal'] = date('Y-m-d', strtotime($data['tanggal_batas_awal']));
        $data['tanggal_batas_akhir'] = date('Y-m-d', strtotime($data['tanggal_batas_akhir']));
        
            Periode::create($data);
            response()->json(['success' => 'Data Berhasil Ditambahkan'], 200);
       

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        
        return response()->json(['periode' => $periode], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        // dd($request->all());
        Log::info('Mengupdate periode');
        $data = request()->validate([
            'tahun' => 'required|integer',
            'tanggal_batas_awal' => 'required|date',
            'tanggal_batas_akhir' => 'required|date',
            'semester' => 'required|string|max:10',
        ]);
        $data['tahun_akademik'] = $data['tahun'] . '/' . ($data['tahun'] + 1);
        $data['status'] = 1;
        $data['tanggal_batas_awal'] = date('Y-m-d', strtotime($data['tanggal_batas_awal']));
        $data['tanggal_batas_akhir'] = date('Y-m-d', strtotime($data['tanggal_batas_akhir']));
        $periode->update($data);
        // return redirect()->back()->with('success', 'Data berhasil diupdate');
        response()->json(['success' => 'Berhasil Mengupdate Data'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
