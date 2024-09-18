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

                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Whoops!</span> There were some problems with your input.
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if (session('success'))
                    <div id="success-message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                @endif

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-slate-800">
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
                                <td class="px-6 py-2">: {{ $attendanceList->course->name }}</td>
                                <td class="px-6 py-2">SKS : {{ $attendanceList->course->sks }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Semester</td>
                                <td class="px-6 py-2">: {{ $semester }}</td>
                                <td class="px-6 py-2">Kelas : {{ $attendanceList->student_class->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Dosen</td>
                                <td colspan="2" class="px-6 py-2">: {{ $attendanceList->lecturer->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2">Jam Perkuliahan</td>
                                <td class="px-6 py-2">: {{ $attendanceList->course->hours }} Jam</td>
                                <td class="px-6 py-2">Tahun Akademik : {{ $academicYear }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-3 flex items-center justify-between">
                        <a href="{{ route('lecturer.lecturer_document.create') }}" class="inline-block">
                            <button type="button"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 text-center">
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4 border border-slate-800">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Pertemuan Ke</th>
                                <th scope="col" class="px-6 py-3">Jumlah Mahasiswa Hadir</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-6 py-3 text-gray-800">{{ $d->meeting_order }}</td>
                                    <td class="px-6 py-3 text-gray-800">{{ $d->sum_attendance_students }}</td>
                                    
                                    <td class="px-3 py-2 flex space-x-1 justify-center">
                                        <a href="{{ route('lecturer.lecturer_document.edit', $d->id) }}" 
                                           class="inline-flex items-center justify-center w-20 text-center font-medium bg-yellow-400 text-white px-2 py-1 rounded-md hover:bg-yellow-500 transition duration-300">
                                            <svg class="w-4 h-4 mr-1 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                            Edit
                                        </a>
                                    
                                        <a href="{{ route('lecturer.lecturer_document.create') }}" class="inline-block">
                                            <button type="button"
                                                class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-1 text-center">
                                                Lengkapi Absensi
                                            </button>
                                        </a>
                                    </td>
                                    
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-3 text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
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
