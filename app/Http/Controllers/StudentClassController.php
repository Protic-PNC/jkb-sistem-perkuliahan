<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentClass::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('academic_year', 'LIKE', "%{$search}%");
            });
        }
        $data = $query->with('study_program')->orderBy('academic_year', 'asc')->paginate(5);
        
        return view('masterdata.student_class.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = StudyProgram::all();
        return view('masterdata.student_class.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'academic_year' => 'required|integer',
        'study_program_id' => 'required|integer',
    ]);

    DB::beginTransaction();
    try {
        // Trim input 'name'
        $sName = trim($request->name);

        // Dapatkan tahun saat ini dan bulan saat ini
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Tentukan semester saat ini berdasarkan bulan
        $currentSemester = ($currentMonth >= 1 && $currentMonth <= 6) ? 2 : 1;

        // Hitung jarak tahun antara academic_year yang diinput dan tahun saat ini
        $yearDifference = $request->academic_year - $currentYear;

        // Tentukan level berdasarkan perbedaan tahun dan semester
        if ($yearDifference == 0 && $currentSemester == 1) {
            $level = 1; // Tahun ini, semester 1
        } elseif ($yearDifference == 0 && $currentSemester == 2) {
            $level = 1; // Tahun ini, semester 2
        } elseif ($yearDifference == 1 && $currentSemester == 1) {
            $level = 2; // Tahun depan, semester 3
        } elseif ($yearDifference == 1 && $currentSemester == 2) {
            $level = 2; // Tahun depan, semester 4
        } elseif ($yearDifference == 2 && $currentSemester == 1) {
            $level = 3; // 2 tahun dari sekarang, semester 5
        } elseif ($yearDifference == 2 && $currentSemester == 2) {
            $level = 3; // 2 tahun dari sekarang, semester 6
        } elseif ($yearDifference == 3 && $currentSemester == 1) {
            $level = 4; // 3 tahun dari sekarang, semester 7
        } elseif ($yearDifference == 3 && $currentSemester == 2) {
            $level = 4; // 3 tahun dari sekarang, semester 8
        } else {
            // Jika tidak sesuai dengan kondisi, beri level default atau kembalikan kesalahan
            return redirect()->back()->with('error', 'Tidak dapat menentukan level berdasarkan tahun akademik yang diinputkan.');
        }

        // Buat instance StudentClass
        $sc = new StudentClass();
        $sc->name = $sName;
        $sc->academic_year = $request->academic_year;
        $sc->level = $level;
        $sc->study_program_id = $request->study_program_id;
        $sc->code = $request->name . $request->academic_year;

        // Simpan data kelas
        $sc->save();

        DB::commit();
        return redirect()->route('masterdata.student_classes.index')->with('success', 'Kelas Berhasil Disimpan');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'System error: ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(StudentClass $studentClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClass $student_class)
    {
        $prodis = StudyProgram::all();
        return view('masterdata.student_class.edit', compact('student_class', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentClass $student_class)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'academic_year' => 'required|integer',
            'study_program_id' => 'required|integer',
        ]);

        $existing = StudentClass::where('academic_year', $validated['academic_year'])
            ->where('study_program_id', $validated['study_program_id'])
            ->first();
            

        if ($existing) {
            return redirect()->back()->with('error', 'Data with the same academic year and study program already exists.');
        }
        try{
            $student_class->update($validated);
            DB::commit();
            return redirect()->route('masterdata.student_class.index')->with('success', 'Kelas Berhasil Diedit');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClass $student_class)
    {
        try{
            $student_class->delete();
            return redirect()->back()->with('success','Projects deleted sussesfully');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
