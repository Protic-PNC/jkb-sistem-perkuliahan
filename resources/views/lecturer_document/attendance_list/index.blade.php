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
                                <th colspan="3" class="px-6 py-3 text-center">DAFTAR HADIR KULIAH</th>
                            </tr>
                            <tr class="bg-gray-100 text-gray-700">
                                <th colspan="3" class="px-6 py-2 text-center ">JURUSAN TEKNIK INFORMATIKA - PROGRAM STUDI
                                    D3 TEKNIK INFORMATIKA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-2">Mata Kuliah</td>
                                <td class="px-6 py-2">: {{ $course->name }}</td>
                                <td class="px-6 py-2">SKS : {{ $course->sks }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Semester</td>
                                <td class="px-6 py-2">: {{ $semester }}</td>
                                <td class="px-6 py-2">Kelas : {{ $student_class->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Dosen</td>
                                <td colspan="2" class="px-6 py-2">: {{ $lecturer->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Jam Perkuliahan</td>
                                <td class="px-6 py-2">: {{ $course->hours }} Jam</td>
                                <td class="px-6 py-2">Tahun Akademik : {{ $academicYear }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-3 flex items-center justify-between">
                        <a href="#" class="inline-block">
                            <button type="button"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 text-center">
                                Tambah Data
                            </button>
                        </a>


                    </div>

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4 border border-slate-800">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NO</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NPM</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">NAMA</th>
                                <th colspan="16" class="px-6 py-3 text-center border border-slate-800">PERTEMUAN KE-</th>
                                <th rowspan="2" class="px-6 py-3 text-center border border-slate-800">Catatan</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <th class="px-1 py-1 border border-slate-800">
                                        <div class="attendance-header">{{ $i }}</div>
                                        <div class="attendance-header">A | T</div>
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
                                    @for ($i = 1; $i <= $course->meeting; $i++)
                                        <td class="px-1 py-1 border border-slate-800">
                                            <div class="attendance-cell flex flex-row items-center justify-center">
                                                <div class="text-xs font-bold border border-slate-800 p-1">A</div>
                                                <div class="text-xs font-bold border border-slate-800 p-1">T</div>
                                            </div>
                                        </td>
                                    @endfor
                                    <td class="px-6 py-2 border border-slate-800"></td>
                                </tr>
                                <!-- Add more student rows as needed -->
                            @endforeach
                            <!-- Add more student rows as needed -->

                            <!-- Additional rows to maintain alignment -->
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800 ">Jumlah mahasiswa</td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 text-center border border-slate-800">20</td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-lef font-semibold border border-slate-800">Tanda tangan ketua
                                    kelas/mahasiswa</td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 border border-slate-800">
                                        <div class="signature-line"></div>
                                    </td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Tanda tangan dosen pengampu
                                </td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 border border-slate-800">
                                        <div class="signature-line"></div>
                                    </td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Tanggal pertemuan</td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 text-center border border-slate-800">__/__/__</td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Jam Perkuliahan</td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 text-center border border-slate-800">_ s/d _</td>
                                @endfor
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-left font-semibold border border-slate-800">Status pertemuan</td>
                                @for ($i = 1; $i <= $course->meeting; $i++)
                                    <td class="px-1 py-1 text-center border border-slate-800">_</td>
                                @endfor
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Legend -->
                    <div class="mt-4 px-6 py-2 legend">
                        <p><strong>KETERANGAN:</strong></p>
                        <p>a : Status pertemuan diisi dengan: &nbsp;&nbsp;&nbsp; a. Sesuai jadwal &nbsp;&nbsp;&nbsp; b.
                            Pengganti &nbsp;&nbsp;&nbsp; c. Tambahan</p>
                        <p>b : Batas keterlambatan mahasiswa adalah 15 menit</p>
                        <p>c : Sakit</p>
                        <p>i : Ijin</p>
                        <p>* : Dosen hanya mengisi daftar hadir mahasiswa dan jurnal dosen, ketua kelas yang mengisi</p>
                    </div>
                </div>
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