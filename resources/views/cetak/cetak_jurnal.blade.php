<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Siperkuliahan') }}</title>
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
            {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th rowspan="2" class="border border-gray-600 p-2">Pertemuan</th>
                                <th rowspan="2" class="border border-gray-600 p-2">Tanggal</th>
                                <th rowspan="2" class="border border-gray-600 p-2">Jumlah Mahasiswa</th>
                                <th rowspan="2" class="border border-gray-600 p-2">Status Pertemuan</th>
                                <th colspan="1" class="border border-gray-600 p-2 text-center">Metode pembelajaran</th>
                                <th rowspan="2" class="border border-gray-600 p-2">Pokok Bahasan/Topik</th>
                                <th colspan="2" class="border border-gray-600 p-2 text-center">Tanda Tangan</th>
                                <th colspan="3" class="border border-gray-600 p-2 text-center">Kolom Kendali</th>
                            </tr>
                            <tr>
                                <th class="border border-gray-600 p-2 text-center">Online/Offline</th>
                                <th class="border border-gray-600 p-2 text-center">Dosen Pengampu</th>
                                <th class="border border-gray-600 p-2 text-center">Ketua Kelas/ <br> Mahasiswa</th>
                                <th class="border border-gray-600 p-2 text-center">Tanggal</th>
                                <th class="border border-gray-600 p-2 text-center">TTD Kaprodi</th>
                                <th class="border border-gray-600 p-2 text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendencedetail as $d)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->meeting_order }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{\Carbon\Carbon::parse( $d->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->sum_attendance_students }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->journal_detail->learning_methods }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->journal_detail->material_course }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->journal_detail->material_course }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->attendenceList?->lecturer->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->student?->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{\Carbon\Carbon::parse( $d->journal_detail->date_acc_kaprod)->translatedFormat('d F Y') }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->kaprodi?->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table> --}}
                <table>
                <thead>
                    <tr>
                        <th rowspan="2">Pertemuan</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Jumlah Mahasiswa</th>
                        <th rowspan="2">Status Pertemuan</th>
                        <th>Metode Pembelajaran</th>
                        <th rowspan="2">Pokok Bahasan/Topik</th>
                        <th colspan="2">Tanda Tangan</th>
                        <th colspan="3">Kolom Kendali</th>
                    </tr>
                    <tr>
                        <th>Online/Offline</th>
                        <th>Dosen Pengampu</th>
                        <th>Ketua Kelas/Mahasiswa</th>
                        <th>Tanggal</th>
                        <th>TTD Kaprodi</th>
                        <th>Keterangan</th>
                    </tr>
                    
                </thead>
                <tbody>
                     @foreach ($attendencedetail as $d)
                    <tr>
                        <td>{{ $d->meeting_order }}</td>
                        <td>{{\Carbon\Carbon::parse( $d->created_at)->translatedFormat('d F Y') }}</td>
                        <td>{{ $d->sum_attendance_students }}</td>
                        <td>{{ $d->journal_detail->learning_methods }}</td>
                        <td>{{ $d->journal_detail->material_course }}</td>
                        <td>{{ $d->journal_detail->material_course }}</td>
                        <td><img src="{{ Storage::url($d->attendenceList?->lecturer->signature ?? ' ' ) }}" alt="" style="height: 8mm" class="header-logo"></td>
                        <td><img src="{{ Storage::url($d->student?->signature ) ?? ' '}}" alt="" style="height: 8mm" class="header-logo"></td>
                        <td>2 Januari 2025</td> 
                        <td><img src="{{ Storage::url($d->journal_detail->kaprodi?->signature) }}" style="height: 8mm" class="header-logo"></td>
                        <td>-</td>
                    </tr>
                    @endforeach
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
                        
                    </tr>
                   
                    
                </tbody>
            </table>

            

        </div>
    </section>
</body>
</html>