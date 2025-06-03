<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\AttendanceList;
use App\Models\AttendanceListDetail;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\Position;
use App\Models\StudentClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class L_PersetujuanDokumenController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = Auth::user();
        $jabatan = Position::where('id', $id)->first();
        
        if($jabatan->name == 'Kepala Jurusan') {
            $prodi_id = $jabatan->prodi_id;
            
            $attendanceLists = AttendanceList::select('attendance_lists.id', 'attendance_lists.student_class_id', 'attendance_lists.course_id','has_acc_kajur') ->where('has_finished','=', 2)->orderBy('id','desc');
    
            if ($request->has('search')) {
                $search = $request->input('search');
                $attendanceLists->where(function ($q) use ($search) {
                    $q->where('student_classes.name', 'LIKE', "%{$search}%")
                        ->orWhere('courses.name', 'LIKE', "%{$search}%")
                        ->orWhere('lecturers.name', 'LIKE', "%{$search}%");
                });
            }
    
            $data = $attendanceLists->paginate(5);
            return view('lecturer.l_lecturer_document.persetujuan.d_pers_index', compact('user', 'data', 'jabatan'));
        
        }
        else if ($jabatan->name == 'Koordinator Program Studi') {
            $prodi_id = $jabatan->prodi_id;
            
            $attendanceLists = AttendanceList::select('attendance_lists.id', 'attendance_lists.student_class_id', 'attendance_lists.course_id')->where('has_finished', 1)->orderBy('id','desc')
                ->whereHas('student_class', function($query) use ($prodi_id) {
                    $query->whereHas('study_program', function($q) use ($prodi_id) {
                        $q->where('id', $prodi_id);
                    });
                });
    
            if ($request->has('search')) {
                $search = $request->input('search');
                $attendanceLists->where(function ($q) use ($search) {
                    $q->where('student_classes.name', 'LIKE', "%{$search}%")
                        ->orWhere('courses.name', 'LIKE', "%{$search}%")
                        ->orWhere('lecturers.name', 'LIKE', "%{$search}%");
                });
            }
    
            $data = $attendanceLists->paginate(5);

           
            return view('lecturer.l_lecturer_document.persetujuan.d_pers_index', compact('user', 'data','jabatan'));
        }
    }

    
    public function details($id)
    {
        $data = AttendanceList::findOrFail($id);

        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();

        $students = $student_class->students;


        $attendencedetail = AttendanceListDetail::where('attendance_list_id', $data->id)
            ->orderBy('meeting_order')
            ->get();
        $jabatan = Auth::user()->lecturer->position->name;
        
            if($jabatan == 'Kepala Jurusan') {
                return view('lecturer.l_lecturer_document.persetujuan.d_pers_kajur_details', compact( 'data', 'attendencedetail', 'students'));
            }
            else if ($jabatan == 'Koordinator Program Studi') {
                return view('lecturer.l_lecturer_document.persetujuan.d_pers_kaprodi_details', compact( 'data', 'attendencedetail', 'students'));
            }
       
    }

    public function verifikasiMassal(Request $request, $id)
    {
        
        $validated= $request->validate([
            'selected_ids'=> 'array|required',
        ]);
        $selected_ids =  $request->input('selected_ids', []);
        
        $ids = $request->input('selected_ids', []);
        $lecturer = Auth::user()->lecturer;
        $jabatan = $lecturer->position->name;
        DB::beginTransaction();
        try{
            if ($jabatan == 'Koordinator Program Studi')
            {
                foreach ($ids as $id) {
                    $data = AttendanceListDetail::find($id);
                    if ($data) {
                        $data->journal_detail->has_acc_kaprodi = 2;
                        $data->journal_detail->date_acc_kaprodi = now();
                        $data->journal_detail->lecturer_kaprodi_id = $lecturer->id;
                        $data->save();
                        $data->journal_detail->save();
                    }
                }
            
            }else if ($jabatan == 'Kepala Jurusan') {
                foreach ($ids as $id) {
                    $data = AttendanceListDetail::find($id);
                    if ($data) {
                        $data->journal_detail->has_acc_kajur = 2;
                        $data->journal_detail->date_acc_kajur = now();
                        $data->journal_detail->lecturer_kajur_id = $lecturer->id;
                        $data->has_acc_kajur = 2;
                        $data->save();
                        $data->journal_detail->save();
                    }
                }
            }
            // dd($data);
            DB::commit();
            return back()->with('success', 'Beberapa pertemuan berhasil diverifikasi.');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }
    public function detail_verifikasi($id)
    {
        $details= AttendanceListDetail::findOrFail($id);
        $data = AttendanceList::where('id', $details->attendance_list_id)->first();

        
        $student_class = StudentClass::with(['students', 'course'])
            ->where('id', $data->student_class_id)
            ->firstOrFail();

        $jabatan = Auth::user()->lecturer->position->name;
        return view('lecturer.l_lecturer_document.persetujuan.d_detail_verifikasi', compact( 'data', 'details', 'jabatan', ));
    }

    public function setuju_kajur($id)
    {
        $al = AttendanceList::findOrFail($id);
        $journal = Journal::where('attendance_list_id', $al->id)->first();
        
        // Cek approval AttendanceListDetail
       
        
        // Jika semua sudah di-approve
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $al->has_acc_kajur = 2;
            $al->date_acc_kajur = now();
            $al->lecturer_kajur_id = $user->lecturer->id;
            $al->save();
            
            if ($journal) {
                $journal->has_acc_kajur = 2;
                $journal->date_acc_kajur = now();
                $journal->lecturer_kajur_id = $user->lecturer->id;
                $journal->save();
            }
            
            DB::commit();
            return back()->with('success', 'Data Berhasil Di Verifikasi!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'System error: ' . $e->getMessage());
        }
    }

    
}
