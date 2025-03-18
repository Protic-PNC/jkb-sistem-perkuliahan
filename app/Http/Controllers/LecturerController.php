<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = lecturer::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query
                ->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")->orWhere('nidn', 'LIKE', "%{$search}%");
                })
                ->orWhere(function ($q) use ($search) {
                    $q->where('nip', 'LIKE', "%{$search}%");
                })
                ->orWhere(function ($q) use ($search) {
                    $q->where('address', 'LIKE', "%{$search}%");
                });
        }

        $lecturers = $query->paginate(5);
        return view('masterdata.lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = Position::all();
        $course = Courses::all();   
        return view('masterdata.lecturers.create', compact('jabatan', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'number_phone' => 'required|string',
            'address' => 'required|string',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
            'nidn' => 'required|string|unique:lecturers,nidn',
            'nip' => 'required|string|unique:lecturers,nip',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            DB::beginTransaction();

            // Menyimpan signature jika ada
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }

            // Membuat lecturer dengan data yang sudah divalidasi
            $lecturer = Lecturer::create($validated);

            DB::commit();
            return redirect()->route('masterdata.lecturers.show')->with('success', 'User Dosen berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer, $id)
    {
        $lecturer = Lecturer::find($id);
        return view('masterdata.lecturers.show', compact('lecturer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer, $id)
    {
        $lecturer = lecturer::find($id);

        return view('masterdata.lecturers.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lecturer = lecturer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'nidn' => [
                'required',
                'string',
                Rule::unique('lecturers', 'nidn')
                    ->ignore($lecturer->id)
                    ->whereNull('deleted_at'),
            ],
            'nip' => [
                'required',
                'string',
                Rule::unique('lecturers', 'nip')
                    ->ignore($lecturer->id)
                    ->whereNull('deleted_at'),
            ],
            'address' => 'required|string',
            'number_phone' => 'required|string',
            'user_id' => ['required', Rule::exists('users', 'id')],
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $validated['signature'] = $signaturePath;
        }
        DB::beginTransaction();
        try {
            $lecturer->update($validated);

            DB::commit();
            return redirect()->route('masterdata.lecturers.index')->with('success', 'User Dosen berhasil Diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        //
    }
}
