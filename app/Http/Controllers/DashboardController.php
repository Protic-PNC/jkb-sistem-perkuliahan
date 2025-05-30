<?php

namespace App\Http\Controllers;

use App\Models\AttendanceList;
use App\Models\AttendanceListStudent;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = User::count();
        $lecturer = Lecturer::count();
        $student = Student::count();

        $periode = $request->input('periode');

    // Ambil periode yang tersedia untuk ditampilkan di dropdown
        $availablePeriods = AttendanceListStudent::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as period")
            ->groupBy('period')
            ->orderByDesc('period')
            ->pluck('period')
            ->toArray();

        // Filter berdasarkan periode (format: 'YYYY-MM')
        $query = AttendanceListStudent::query();
        if ($periode) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$periode]);
        }

        $attendanceData = $query->get();

        // Hitung jumlah masing-masing status kehadiran
        $defaultCounts = [
            1 => 0, // Hadir
            2 => 0, // Telat
            3 => 0, // Sakit
            4 => 0, // Izin
            5 => 0, // Bolos
        ];

        foreach ($attendanceData as $record) {
            $status = $record->attendance_student;
            if (isset($defaultCounts[$status])) {
                $defaultCounts[$status]++;
            }
        }

        $labels = ['Hadir', 'Telat', 'Sakit', 'Izin', 'Bolos'];
        $data = array_values($defaultCounts);
        return view('masterdata.dashboard', [
            'auth' => $auth,
            'user' => $user,
            'lecturer' => $lecturer,
            'student' => $student,
            'attendanceCounts' => $defaultCounts,
            'labels' => $labels,
            'data' => $data,
            'availablePeriods' => $availablePeriods,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
