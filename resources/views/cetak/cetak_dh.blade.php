<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Attendix') }}</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        body {
            background: white !important;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
            font-size: 8pt;
        }
       

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 3mm;
        }

         .header-logo {
        width: 60px; /* Ukuran logo lebih kecil */
        height: auto;
    }

        .header-text {
            text-align: center;
        }

        .table-title {
            font-size: 10pt;
            font-weight: bold;
            margin: 0;
        }

        .department-title {
            font-size: 9pt;
            margin: 0;
            font-weight: 500;
        }

        table {
            font-size: 7pt !important;
            border-collapse: collapse;
            width: 100%;
            background: white;
            page-break-inside: avoid;
        }

        th, td {
            padding: 2px 3px !important;
            border: 0.5pt solid #000 !important;
            background: white;
            line-height: 1.2;
        }

        th {
            background-color: #f3f4f6 !important;
            font-weight: 600;
        }

        .attendance-header {
            font-size: 6pt;
            text-align: center;
            background: #f3f4f6;
            padding: 1px !important;
        }

        .attendance-cell {
            width: 6mm;
            text-align: center;
            padding: 1px !important;
        }

        .signature-line {
            border-bottom: 0.5pt solid black;
            height: 8mm;
        }

     .legend {
    font-size: 6.5pt;
}

.legend-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10mm;
    margin-top: 2mm;
    flex-wrap: wrap; /* responsif di layar kecil */
}

.legend-section {
    flex: 1 1 45%; /* ambil 45% dari lebar container */
    box-sizing: border-box;
}

.legend-table {
    font-size: 6pt;
    border-collapse: collapse;
    width: 100%;
}

.legend-table th,
.legend-table td {
    text-align: left;
    padding: 1mm;
    border: 1px solid #ddd;
}

.legend-list {
    list-style-type: disc;
    padding-left: 5mm;
    font-size: 6.5pt;
}

.legend-list ul {
    list-style-type: lower-alpha;
    padding-left: 5mm;
    margin-top: 1mm;
}

.legend-list li {
    margin-top: 1mm;
}

.legend-main-table {
    border: none !important;
}


    </style>
</head>

<body >
    <section>
        <div style="padding: 2mm;">
            <!-- Header dengan logo dan judul sejajar -->
            {{-- <div class="header-container">
                <img src="image/image.png" alt="Logo Institusi" class="header-logo">
                <div class="header-text">
                    <h1 class="table-title">DAFTAR HADIR KULIAH</h1>
                    <div class="department-title">
                        JURUSAN TEKNIK INFORMATIKA - PROGRAM STUDI {{ $data->student_class->study_program->jenjang }} -
                        {{ $data->student_class->study_program->name }}
                    </div>
                </div>
            </div> --}}
            <table class="compact-table mb-2">
                
                <tbody>
                    <tr>
                        <td><img src="image/image.png" alt="Logo Institusi" class="header-logo"></td>
                        <td class="table-title" style="text-align: center;"><strong>DAFTAR HADIR KULIAH</strong> <br>JURUSAN TEKNIK INFORMATIKA - PROGRAM STUDI {{ $data->student_class->study_program->jenjang }} -
                        {{ $data->student_class->study_program->name }}
                    </td>
                        
                    </tr>
                   
                    
                </tbody>
            </table>

            <!-- Informasi Mata Kuliah -->
            <table class="compact-table mb-2">
                <tbody>
                    <tr>
                        <td style="width: 15%;"><strong>Mata Kuliah</strong></td>
                        <td style="width: 35%;">: {{ $data->course->name }}</td>
                        <td style="width: 10%;"><strong>SKS</strong></td>
                        <td style="width: 15%;">: {{ $data->course->sks }}</td>
                    </tr>
                    <tr>
                        <td><strong>Semester</strong></td>
                        <td>: {{ $data->periode->tahun }} {{ $data->periode->semester }}</td>
                        <td><strong>Kelas</strong></td>
                        <td>: {{ $data->student_class->study_program->name }} {{ $data->student_class->level }} {{ $data->student_class->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dosen</strong></td>
                        <td>: {{ $data->lecturer->name }}</td>
                        <td><strong>Tahun Akademik</strong></td>
                        <td>: {{ $data->periode->tahun_akademik }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jam Perkuliahan</strong></td>
                        <td>: {{ $data->course->hours }} Jam</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Tabel Utama -->
            <table style="margin-top: 2mm;">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 5mm; text-align: center;">NO</th>
                        <th rowspan="2" style="width: 15mm; text-align: center;">NPM</th>
                        <th rowspan="2" style="text-align: center;">NAMA</th>
                        <th colspan="32" style="text-align: center;">PERTEMUAN KE-</th>
                        <th rowspan="2" style="width: 15mm; text-align: center;">Catatan</th>
                    </tr>
                    
                     <tr>
                                @for ($i = 1; $i <= 16; $i++)
                                    <th colspan="2" class="attendance-cell">
                                        <div class="attendance-header">{{ $i }}</div>
                                        <div class="attendance-subheader">A | T</div>
                                    </th>
 
                                @endfor
                            </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-2 py-2 text-center border border-slate-800">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-2 border border-slate-800">{{ $student->nim }}</td>
                                    <td class="px-2 py-2 border border-slate-800">{{ $student->name }}</td>
                                    
                                    @php
                                        // Initialize empty collection if relationship returns null
                                        $studentAttendances = $student->attendence_list_student ? $student->attendence_list_student->keyBy('attendance_list_detail_id') : collect();
                                    @endphp

                                    @foreach ($attendencedetails as $detail)
                                        @php
                                            $attendance = $studentAttendances->get($detail->id);
                                        @endphp
                                        
                                        <td class="attendance-cell border border-slate-800 text-center">
                                            @if($attendance)
                                                @switch($attendance->attendance_student)
                                                    @case(1) H @break
                                                    @case(2) T @break
                                                    @case(3) S @break
                                                    @case(4) I @break
                                                    @case(5) B @break
                                                    @default - 
                                                @endswitch
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="attendance-cell border border-slate-800 text-center">
                                            {{ $attendance->minutes_late ?? '-' }}
                                        </td>
                                    @endforeach

                                    @for ($i = count($attendencedetails); $i < $totalMeetings; $i++)
                                        <td colspan="2" class="px-1 py-1 text-center border border-slate-800">-</td>
                                    @endfor
                                </tr>
                            @endforeach --}}
                    {{-- @foreach ($students as $student)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $student->nim }}</td>
                            <td>{{ $student->name }}</td>
                            @php
                                $totalMeetings = 16;
                                $rendered = 0;
                                $attendanceCollection = $student->attendence_list_student ?? collect();
                            @endphp

                            @if ($attendencedetail->isEmpty())
                                @for ($i = 0; $i < $totalMeetings; $i++)
                                    <td colspan="2" style="text-align: center;">-</td>
                                @endfor
                            @else
                                @foreach ($attendencedetail as $detail)
                                    @php
                                        $attendanceRecord = $attendanceCollection->where('attendance_list_detail_id', $detail->id)->first();
                                        $rendered++;
                                    @endphp

                                    <td class="attendance-cell">
                                        @if($attendanceRecord)
                                                    @if ($attendanceRecord->attendance_student == 1)
                                                    H
                                                    @elseif($attendanceRecord->attendance_student == 2)
                                                    T 
                                                    @elseif($attendanceRecord->attendance_student == 3)
                                                    S
                                                    @elseif($attendanceRecord->attendance_student == 4)
                                                    I
                                                    @elseif($attendanceRecord->attendance_student == 5)
                                                    B
                                                    @else

                                                    @endif
                                                @endif
                                    </td>
                                    <td class="attendance-cell">
                                        {{ $attendanceRecord->sum_late_students ?? '-' }}
                                    </td>
                                @endforeach

                                @for ($i = $rendered; $i < $totalMeetings; $i++)
                                    <td colspan="2" style="text-align: center;">-</td>
                                @endfor
                            @endif
                            <td></td>
                        </tr>
                    @endforeach --}}

                    @foreach ($students as $student)
    <tr>
        <td style="text-align: center; border: 1px solid black; padding: 5px;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid black; padding: 5px;">{{ $student->nim }}</td>
        <td style="border: 1px solid black; padding: 5px;">{{ $student->name }}</td>
        
        @php
            $totalMeetings = 16;
            $rendered = 0;
            $attendanceCollection = $student->attendence_list_student ?? collect();
        @endphp

        @if ($attendencedetail->isEmpty())
            @for ($i = 0; $i < $totalMeetings; $i++)
                <td colspan="2" style="text-align: center; border: 1px solid black; padding: 2px;">-</td>
            @endfor
        @else
            @foreach ($attendencedetail as $detail)
                @php
                    $attendanceRecord = $attendanceCollection->where('attendance_list_detail_id', $detail->id)->first();
                    $rendered++;
                @endphp

                <td class="attendance-cell" style="text-align: center; border: 1px solid black; padding: 5px;">
                    @if($attendanceRecord)
                        @if ($attendanceRecord->attendance_student == 1)
                            H
                        @elseif($attendanceRecord->attendance_student == 2)
                            T 
                        @elseif($attendanceRecord->attendance_student == 3)
                            S
                        @elseif($attendanceRecord->attendance_student == 4)
                            I
                        @elseif($attendanceRecord->attendance_student == 5)
                            B
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td class="attendance-cell" style="text-align: center; border: 1px solid black; padding: 5px;">
                    {{ $attendanceRecord->sum_late_students ?? '-' }}
                </td>
            @endforeach

            @for ($i = $rendered; $i < $totalMeetings; $i++)
                <td colspan="2" style="text-align: center; border: 1px solid black; padding: 2px;">-</td>
            @endfor
        @endif
        <td style="border: 1px solid black;"></td>
    </tr>
@endforeach

                    <!-- Footer Tabel -->
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Jumlah mahasiswa</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                            @endphp
                            <td colspan="2" style="text-align: center;">
                                {{ $currentDetail->sum_attendance_students ?? ' ' }}
                            </td>
                        @endfor
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Tanda tangan ketua kelas/mahasiswa</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                            @endphp
                            <td colspan="2" style="text-align: center;">
                                @if ($currentDetail && $currentDetail->student && $currentDetail->student->signature)
                                    <img src="{{ public_path('storage/' . $currentDetail->student->signature) }}" alt=""  style="max-width: 100%; max-height: 20px; object-fit: contain;" class="header-logo">
                                @else
                                    <span>-</span>
                                @endif
                            </td>

                        @endfor
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Tanda tangan dosen pengampu</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                            @endphp
                            {{-- <td colspan="2" style="text-align: center;">
                                <img src="{{ public_path('storage/' . $currentDetail->attendenceList?->lecturer->signature ?? '') }}" alt="" style="height: 4mm" class="header-logo">
                                
                            </td> --}}
                            <td colspan="2" style="text-align: center;">
                                @if ($currentDetail && $currentDetail->attendenceList->lecturer && $currentDetail->attendenceList?->lecturer->signature)
                                    <img src="{{ public_path('storage/' . $currentDetail->attendenceList->lecturer->signature) }}" alt=""  style="max-width: 100%; max-height: 20px; object-fit: contain;" class="header-logo">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        @endfor
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Tanggal pertemuan</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                $date = $currentDetail ? \Carbon\Carbon::parse($currentDetail->created_at)->format('d M Y') : '';
                            @endphp
                            <td colspan="2" style="text-align: center;">
                                {{ $date }}
                            </td>
                        @endfor
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Jam Perkuliahan</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                $start_hour = $currentDetail->start_hour ?? '-';
                                $end_hour = $currentDetail->end_hour ?? '-';
                            @endphp
                            <td colspan="2" style="text-align: center;">
                                {{ $start_hour }} s/d {{ $end_hour }}
                            </td>
                        @endfor
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Status pertemuan</td>
                        @for ($i = 1; $i <= 16; $i++)
                            @php
                                $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                $course_status = $currentDetail->course_status ?? '-';
                            @endphp
                            <td colspan="2" style="text-align: center;">
                                @if ($course_status == 1)
                                    Sesuai Jadwal
                                @elseif ($course_status == 2)
                                    Pengganti
                                @elseif ($course_status == 3)
                                    Tambahan
                                @endif
                            </td>
                        @endfor
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <table class="legend-main-table mb-2">
                
                <tbody>
                    <tr>
                        <td>
                            <div class="legend-section">
                                <table class="legend-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 5mm;">Kode</th>
                                            <th style="width: 15mm;">Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>T</td><td>Telat</td><td></td></tr>
                                        <tr><td>H</td><td>Hadir</td><td></td></tr>
                                        <tr><td>B</td><td>Bolos</td><td></td></tr>
                                        <tr><td>S</td><td>Sakit</td><td></td></tr>
                                        <tr><td>I</td><td>Izin</td><td></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td> 
                            <div class="legend-section">
                                <ul class="legend-list">
                                    <li>Status pertemuan diisi dengan:
                                        <ul>
                                            <li>a. Sesuai Jadwal</li>
                                            <li>b. Pengganti</li>
                                            <li>c. Tambahan</li>
                                        </ul>
                                    </li>
                                    <li>1 SKS = 50 menit</li>
                                    <li>Dosen hanya mengisi daftar hadir mahasiswa dan jurnal dosen, sedangkan ketua kelas yang mengisi absen</li>
                                    <li>Ketua kelas mengambil absen</li>
                                </ul>
                            </div>
                        </td>
                        <td> 
                             <div class="legend-section">
                                @if($data->has_acc_kajur ==2)
                                Cilacap, {{ \Carbon\Carbon::parse($data->date_acc_kajur)->format('d M Y')  }}
                                <br>
                                Ketua,
                                <br>
                                @if ($data->kajur && $data->kajur?->signature)
                                <img src="{{ public_path('storage/' . $data->kajur?->signature ?? '') }}" alt="" style="height: 8mm" class="header-logo">
                                @else
                                    <span>-</span>
                                @endif
                                <br>
                                <p style="text-decoration: underline;">
                                {{ $data->kajur->name }}
                                </p>
                                NIP. {{ $data->kajur->nip }}
                                @endif
                            </div>
                        </td>
                        
                    </tr>
                   
                    
                </tbody>
            </table>

            

        </div>
    </section>
</body>
</html>