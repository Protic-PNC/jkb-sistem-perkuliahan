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
                    <table class="w-full border-collapse font-sans border border-slate-800">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th colspan="6" class="p-3 text-center text-lg font-bold">JURNAL DOSEN DAN REKAMAN MATERI PERKULIAHAN</th>
                            </tr>
                            <tr class="bg-gray-100 text-gray-700">
                                <th colspan="6" class="p-2 text-center text-sm font-medium uppercase">JURUSAN Komputer DAN BISNIS - PROGRAM STUDI D3 TEKNIK INFORMATIKA</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="p-2 w-1/5">Mata Kuliah</td>
                                <td class="p-2 w-2/5">: Praktek Pomrograman Web 1</td>
                                <td class="p-2 w-1/5">Semester</td>
                                <td class="p-2 w-1/5">: IV (Empat)</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="p-2">Dosen</td>
                                <td class="p-2">: Prih Diantono Abatvi, S.Kom., M.Kom.</td>
                                <td class="p-2">Kelas</td>
                                <td class="p-2">: TI 2A</td>
                            </tr>
                            <tr>
                                <td class="p-2">SKS</td>
                                <td class="p-2">: 2</td>
                                <td class="p-2">Tahun Akademik</td>
                                <td class="p-2">: 2024/2025</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th class="px-6 py-3 text-center border border-slate-800">No</th>
                                <th class="px-6 py-3 text-center border border-slate-800">Tanggal</th>
                                <th class="px-6 py-3 text-center border border-slate-800">Jam</th>
                                <th class="px-6 py-3 text-center border border-slate-800">Status Pertemuan</th>
                                <th class="px-6 py-3 text-center border border-slate-800">Metode Pembelajaran</th>
                                <th class="px-6 py-3 text-center border border-slate-800">Pokok Bahasan / Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 9; $i++)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-2 py-2 text-center border border-slate-800">{{ $i }}</td>
                                    <td class="px-2 py-2 text-center border border-slate-800">10/02/2025</td>
                                    <td class="px-2 py-2 text-center border border-slate-800">2.2</td>
                                    <td class="px-2 py-2 text-center border border-slate-800">a</td>
                                    <td class="px-2 py-2 text-center border border-slate-800">offline</td>
                                    <td class="px-2 py-2 text-center border border-slate-800">
                                        @if ($i == 1)
                                            Pemrograman
                                        @elseif ($i == 2)
                                             instalasi Laravel
                                        @elseif ($i == 3)
                                            Struktur zzfolder
                                        @elseif ($i == 4)
                                            Routes
                                        @elseif ($i == 5)
                                            Middleware
                                        @elseif ($i == 6)
                                            Controller
                                        @elseif ($i == 7)
                                            Views
                                        @elseif ($i == 8)
                                            Blade
                                        @elseif ($i == 9)
                                            Query Builder
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <button type="button" id="btn-verifikasi" class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-medium rounded-lg text-sm m-4 px-4 py-1 text-center">
                    <i class="fa fa-check"></i> Cetak </button>
            </div>
        </section>
    @endsection
</x-app-layout>