<x-app-layout>
    @section('main_folder', '/ Dokumen Perkuliahan')
    @section('descendant_folder', '/ Daftar / Jurnal Dosen dan Rekaman Materi Perkuliahan')

    @section('content')
        <style>
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
                <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    Jurnal Dosen dan Rekaman Materi Perkuliahan
                </h3>

                {{-- @if ($attendencedetail->count() > 3)
                    <a href="{{ route('cetak.jurnal', $data->id) }}"
                    id="btn-verifikasi{{ $data->id }}"
                    class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold rounded-lg text-base px-6 py-3 inline-flex items-center">
                        <i class="fa fa-print mr-2 text-lg"></i> Cetak
                    </a>
                @endif --}}
            </div>
               

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th colspan="4" class="p-3 text-center text-lg font-bold">JURNAL PERKULIAHAN</th>
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
                                <td class="px-2 py-2 text-center border border-slate-800">@if($d->course_status == 1)
                                    Sesuai Jadwal
                                    @elseif($d->course_status == 2)
                                    Pertukaran
                                    @elseif($d->course_status == 3)
                                    Pengganti
                                    @elseif($d->course_status == 4)
                                    Tambahan
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->journal_detail->learning_methods }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{ $d->journal_detail->material_course }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->attendenceList?->lecturer->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->student?->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                                <td class="px-2 py-2 text-center border border-slate-800">{{\Carbon\Carbon::parse( $d->journal_detail->date_acc_kaprod)->translatedFormat('d F Y') }}</td>
                                <td class="px-2 py-2 text-center border border-slate-800 "><img src="{{ Storage::url($d->kaprodi?->signature ) }}" alt="" class="object-cover w-[20px] h-90px rounded-2xl"></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
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
                                            <li>Sesuai Jadwal</li>
                                            <li>Pertukaran</li>
                                            <li>Pengganti</li>
                                            <li>Tambahan</li>
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
                
            </div>
        </section>
    @endsection
</x-app-layout>