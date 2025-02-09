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
                    

                    <div class="overflow-x-auto">  
                        <table class="w-full text-sm text-left text-gray-700 border border-slate-800 border-collapse">  
                            <thead class="bg-gray-900 text-white">  
                                <tr>  
                                    <th class="px-4 py-2 border border-slate-800">Pertemuan</th>  
                                    <th class="px-4 py-2 border border-slate-800">Tanggal</th>  
                                    <th class="px-4 py-2 border border-slate-800">Jumlah Mahasiswa</th>  
                                    <th class="px-4 py-2 border border-slate-800">Status Pertemuan</th>  
                                    <th class="px-4 py-2 border border-slate-800">Metode Pembelajaran</th>  
                                    <th class="px-4 py-2 border border-slate-800">Pokok Bahasan / Kegiatan</th>  
                                    <th class="px-4 py-2 border border-slate-800">Tanda Tangan Dosen Pengampu</th>  
                                    <th class="px-4 py-2 border border-slate-800">Ketua Kelas / Mahasiswa</th>  
                                    <th class="px-4 py-2 border border-slate-800">Tanggal</th>  
                                    <th class="px-4 py-2 border border-slate-800">TTD Kajur / Koord. Prodi</th>  
                                    <th class="px-4 py-2 border border-slate-800">Keterangan</th>  
                                </tr>  
                            </thead>  
                            <tbody>  
                                <!-- Contoh baris data -->  
                                <tr class="bg-white">  
                                    <td class="px-4 py-2 border border-slate-800 text-center">1</td>  
                                    <td class="px-4 py-2 border border-slate-800">01/10/2023</td>  
                                    <td class="px-4 py-2 border border-slate-800 text-center">30</td>  
                                    <td class="px-4 py-2 border border-slate-800">Sesuai Jadwal</td>  
                                    <td class="px-4 py-2 border border-slate-800">Ceramah</td>  
                                    <td class="px-4 py-2 border border-slate-800">Pengenalan Mata Kuliah</td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">01/10/2023</td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">-</td>  
                                </tr>  
                                <!-- Tambahkan baris data lainnya sesuai kebutuhan -->  
                                <tr class="bg-white">  
                                    <td class="px-4 py-2 border border-slate-800 text-center">2</td>  
                                    <td class="px-4 py-2 border border-slate-800">08/10/2023</td>  
                                    <td class="px-4 py-2 border border-slate-800 text-center">30</td>  
                                    <td class="px-4 py-2 border border-slate-800">Sesuai Jadwal</td>  
                                    <td class="px-4 py-2 border border-slate-800">Diskusi</td>  
                                    <td class="px-4 py-2 border border-slate-800">Konsep Dasar</td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">08/10/2023</td>  
                                    <td class="px-4 py-2 border border-slate-800">  
                                        <div class="h-8 border-b-2 border-black"></div>  
                                    </td>  
                                    <td class="px-4 py-2 border border-slate-800">-</td>  
                                </tr>  
                            </tbody>  
                        </table>  
                    </div>  

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