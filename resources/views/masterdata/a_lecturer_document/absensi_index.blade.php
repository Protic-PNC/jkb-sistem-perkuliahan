<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Daftar Hadir Kuliah')

    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
            .attendance-header {
                font-size: 0.6rem;
                text-align: center;
            }
            .attendance-cell {
                width: 40px;
                text-align: center;
                font-size: 0.7rem;
            }
            .signature-line {
                border-bottom: 1px solid black;
                height: 30px;
            }
            .legend {
                font-size: 0.8rem;
            }
            
        </style>

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Hadir Kuliah</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
                </div>

                <!-- Error and success messages remain unchanged -->

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th colspan="4" class="p-3 text-center text-lg font-bold">DAFTAR HADIR KULIAH</th>
                            </tr>
                            <tr class="bg-gray-100 text-gray-700">
                                <th colspan="4" class="p-2 text-center text-sm font-medium uppercase">JURUSAN TEKNIK INFORMATIKA - PROGRAM STUDI {{  $data->student_class->study_program->jenjang }} -
                                    {{ $data->student_class->study_program->name }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="p-2 w-1/5">Mata Kuliah</td>
                                <td class="p-2 w-2/5">: {{ $data->course->name }}</td>
                                <td class="p-2 w-1/5">SKS</td>
                                <td class="p-2 w-1/5">: {{ $data->course->sks }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="p-2">Semester</td>
                                <td class="p-2">: {{ $data->periode->tahun }} {{ $data->periode->semester }}</td>
                                <td class="p-2">Kelas</td>
                                <td class="p-2">: {{ $data->student_class->study_program->name }} {{ $data->student_class->level }} {{ $data->student_class->name }}</td>
                            </tr>
                            <tr>
                                <td class="p-2">Dosen</td>
                                <td class="p-2">: {{ $data->lecturer->name }}</td>
                                <td class="p-2">Tahun Akademik</td>
                                <td class="p-2">: {{ $data->periode->tahun_akademik }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="p-2">Jam Perkuliahan</td>
                                <td class="p-2">: {{ $data->course->hours }} Jam</td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NO</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NPM</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NAMA</th>
                                <th colspan="32" class="px-6 py-3 text-center border border-slate-800">PERTEMUAN KE-</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">Catatan</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 16; $i++)
                                    <th colspan="2" class="border border-black text-center">
                                        <div class="attendance-header">{{ $i }}</div>
                                        <div class="flex">
                                            <div class="w-1/2 border-r border-black attendance-header">A</div>
                                            <div class="w-1/2 attendance-header">T</div>
                                        </div>
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample student row -->
                            @foreach ($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-2 py-2 text-center border border-slate-800">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-2 border border-slate-800">{{ $student->nim }}</td>
                                    <td class="px-2 py-2 border border-slate-800">{{ $student->name }}</td>
                                    @foreach ($attendencedetail as $detail)
                                        @php
                                            $attendanceRecord = $student->attendence_list_student
                                                ->where('attendance_list_detail_id', $detail->id)
                                                ->first();
                                        @endphp
                                        
                                        <!-- Attendance Status (A) -->
                                        <td class="attendance-cell border border-slate-800 text-center">
                                            {{ $attendanceRecord->attendance_student ?? '-' }}
                                        </td>
                                        
                                        <!-- Late Minutes (T) -->
                                        <td class="attendance-cell border border-slate-800 text-center">
                                            {{ $attendanceRecord->minutes_late ?? '-' }}
                                        </td>
                                    @endforeach
                                    
                                </tr>
                                <!-- Add more student rows as needed -->
                            @endforeach
                            <!-- Add more student rows as needed -->

                            <!-- Additional rows to maintain alignment -->
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Jumlah mahasiswa</td>
                                @for ($i = 1; $i <= 16; $i++)
                                    @php
                                        $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                    @endphp
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">
                                        {{ $currentDetail->sum_attendance_students ?? ' ' }}
                                    </td>
                                @endfor
                                
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-lef font-semibold border border-slate-800">Tanda tangan ketua
                                    kelas/mahasiswa</td>
                                @for ($i = 1; $i <= 16; $i++)
                                    <td colspan="2" class="px-1 py-1 border border-slate-800">
                                        <div class="signature-line"></div>
                                    </td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Tanda tangan dosen pengampu
                                </td>
                                @for ($i = 1; $i <= 16; $i++)
                                    <td colspan="2" class="px-1 py-1 border border-slate-800">
                                        <div class="signature-line"></div>
                                    </colspan=>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Tanggal pertemuan</td>
                                {{-- @for ($i = 1; $i <= 16; $i++)
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">{{ \Carbon\Carbon::parse($u->created_at)->format('d M Y') }}</colspan=>
                                @endfor --}}
                                @for ($i = 1; $i <= 16; $i++)
                                    @php
                                        $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                        $date = $currentDetail ? \Carbon\Carbon::parse($currentDetail->created_at)->format('d M Y') : '';
                                    @endphp
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">
                                        {{ $date }}
                                    </td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Jam Perkuliahan</td>
                                {{-- @for ($i = 1; $i <= 16; $i++)
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">_ s/d _</colspan=>
                                @endfor --}}
                                @for ($i = 1; $i <= 16; $i++)
                                    @php
                                        $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                        $start_hour = $currentDetail->start_hour ?? '-';
                                        $end_hour = $currentDetail->end_hour ?? '-';
                                    @endphp
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">
                                        {{ $start_hour }} s/d {{ $end_hour }}
                                    </td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Status pertemuan</td>
                                {{-- @for ($i = 1; $i <= 16; $i++)
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">_</colspan=>
                                @endfor --}}
                                @for ($i = 1; $i <= 16; $i++)
                                    @php
                                        $currentDetail = $attendencedetail->where('meeting_order', $i)->first();
                                        $course_status = $currentDetail->course_status ?? '-';
                                       
                                    @endphp
                                    <td colspan="2" class="px-1 py-1 text-center border border-slate-800">
                                        @if ($course_status == 1)
                                            Sesuai Jadwal
                                        @elseif ($course_status == 2)
                                            Pengganti
                                        @elseif ($course_status == 3)
                                            Tambahan
                                        @endif
                                    </td>
                                @endfor
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Legend -->
                    <div class="mt-4 px-6 py-2 legend border-t border-gray-300">
                        <p><strong>KETERANGAN:</strong></p>
                        
                        <div class="grid grid-cols-3 gap-4 mt-2">
                            <!-- Status Kehadiran Table -->
                            <div class="col-span-1">
                                <table class="w-full border border-gray-400">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="border border-gray-400 px-2 py-1 text-left">T</th>
                                            <th class="border border-gray-400 px-2 py-1 text-left">Telat</th>
                                            <th class="border border-gray-400 px-2 py-1 text-left">KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border border-gray-400 px-2 py-1">H</td>
                                            <td class="border border-gray-400 px-2 py-1">Hadir</td>
                                            <td class="border border-gray-400 px-2 py-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-400 px-2 py-1">B</td>
                                            <td class="border border-gray-400 px-2 py-1">Bolos</td>
                                            <td class="border border-gray-400 px-2 py-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-400 px-2 py-1">S</td>
                                            <td class="border border-gray-400 px-2 py-1">Sakit</td>
                                            <td class="border border-gray-400 px-2 py-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-400 px-2 py-1">I</td>
                                            <td class="border border-gray-400 px-2 py-1">Ijin</td>
                                            <td class="border border-gray-400 px-2 py-1"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Additional Notes -->
                            <div class="col-span-2 pl-4">
                                <ul class="list-disc pl-5 text-sm">
                                    <li>Status pertemuan diisi dengan:
                                        <ul class="list-disc pl-5 mt-1">
                                            <li>a. Sesuai Jadwal</li>
                                            <li>b. Pengganti</li>
                                            <li>c. Tambahan</li>
                                        </ul>
                                    </li>
                                    <li class="mt-1">1 SKS = 50 menit</li>
                                    <li class="mt-1">Dosen hanya mengisi daftar hadir mahasiswa dan jurnal dosen, sedangkan ketua kelas yang mengisi absen</li>
                                    <li class="mt-1">Ketua kelas mengambil absen</li>
                                </ul>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="btn-verifikasi" class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-medium rounded-lg text-sm m-4 px-4 py-1 text-center">
                    <i class="fa fa-check"></i> Cetak </button>
            </div>
            
        </section>

        @push('after-script')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        setTimeout(function() {
                            successMessage.style.opacity = '0';
                            setTimeout(function() {
                                successMessage.remove();
                            }, 500);
                        }, 3000);
                    }
                });
            </script>
        @endpush
    @endsection
</x-app-layout>