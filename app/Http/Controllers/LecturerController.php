<?php

namespace App\Http\Controllers;

use App\Models\CourseLecturer;
use App\Models\Courses;
use App\Models\Lecturer;
use App\Models\Position;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = lecturer::query()->orderBy('id','desc');

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
        $jabatan = Position::with('prodis')->get();
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
            'position_id' => 'nullable|exists:positions,id', 
            'course_id' => 'nullable|array', 
            'course_id.*' => 'exists:courses,id', 
        ]);
        
        DB::beginTransaction();
        try {
            
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }
            $user = User::create([
                'name' => $request->nidn,
                'avatar' => null,
                'email' => $request->nidn . '@pnc.ac.id',
                'password' => Hash::make($request->nidn),
            ]);
            // dd($user);
            $validated['user_id'] = $user->id;
            
            $lecturer = Lecturer::create($validated);
            // dd($lecturer);
            if (!empty($request->course_id)) {
                foreach ($request->course_id as $courseId) {
                    $cl =  CourseLecturer::create([
                        'course_id' => $courseId,
                        'lecturer_id' => $lecturer->id,
                    ]);
                }
            }
            
            $user->assignRole('dosen');

            DB::commit();
            return redirect()->route('masterdata.lecturers.index')->with('success', 'Dosen berhasil disimpan');
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
    public function edit( $id)
    {
        $lecturer = lecturer::with('course')->find($id);
        $jabatan = Position::with('prodis')->get();
        $course = Courses::all();  
        return view('masterdata.lecturers.edit', compact('lecturer', 'jabatan', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lecturer = lecturer::findOrFail($id);
        // dd($request->all());
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
            'position_id' => 'nullable|exists:positions,id', 
            'course_id' => 'nullable|array', 
            'course_id.*' => 'exists:courses,id', 
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        DB::beginTransaction();
        try {
            $lecturerupdate = Lecturer::updateOrCreate(
                ['id' => $lecturer->id], 
                $validated 
            );
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('signatures', 'public');
                $validated['signature'] = $signaturePath;
            }
            $data = [
                'name' => $validated['nidn'],
                'email' => $validated['nidn']. '@pnc.ac.id',
                'password' => Hash::make($request->nidn),
            ];
            // dd($data);
            $user = User::where('id', $lecturer->user_id)->first();
            $user->update($data);
            CourseLecturer::where('lecturer_id', $lecturer->id)->delete();
            if (!empty($request->course_id)) {
                foreach ($request->course_id as $courseId) {
                    $cl =  CourseLecturer::create([
                        'course_id' => $courseId,
                        'lecturer_id' => $lecturer->id,
                    ]);
                    
                }
            }
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
    public function destroy($id)
    {
        $lecturer = Lecturer::findOrFail($id);
        try{
            $lecturer->delete();
            return redirect()->back()->with('success','Mahasiswa deleted sussesfully');
        }
        catch(Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System eror'.$e->getMessage());
        }
    }
}
