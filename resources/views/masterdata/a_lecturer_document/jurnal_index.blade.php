<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Jurnal Dosen dan Rekaman Materi Perkuliahan')

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
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Jurnal Dosen dan Rekaman Materi Perkuliahan</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
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
                    </table>
                </div>
                <button type="button" id="btn-verifikasi" class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-medium rounded-lg text-sm m-4 px-4 py-1 text-center">
                    <i class="fa fa-check"></i> Cetak </button>
            </div>
        </section>
    @endsection
</x-app-layout>