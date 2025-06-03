<x-app-layout>
    @section('main_folder', '/ Dokumen Perkuliahan')

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
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Dokumen Perkuliahan</h3>
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

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-slate-800">
                    
                    <table class="w-full border-collapse font-sans">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th colspan="4" class="p-3 text-center text-lg font-bold">Dokumen Perkuliahan</th>
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
                    
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4 border-collapse">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">Pertemuan Ke</th>
                                <th scope="col" class="px-6 py-3 text-center">Jumlah Mahasiswa Hadir</th>
                                <th scope="col" class="px-6 py-3 text-center">Status Pertemuan</th>
                                <th scope="col" class="px-6 py-3 text-center">Metode Pembelajaran</th>
                                <th scope="col" class="px-6 py-3 text-center">Materi Perkuliahan</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendencedetail as $d)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-center align-middle">{{ $d->meeting_order }}</td>
                                <td class="px-6 py-4 text-center align-middle">{{ $d->sum_attendance_students }}</td>
                                <td class="px-6 py-4 text-center align-middle">
                                    @if ($d->course_status == 1)
                                    Sesuai Jadwal
                                    @elseif ($d->course_status == 2)
                                    Pertukaran
                                    @elseif ($d->course_status == 3)
                                    Pengganti
                                    @elseif ($d->course_status == 4)
                                    Tambahan
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center align-middle">{{ $d->journal_detail->learning_methods}}</td>
                                <td class="px-6 py-4 text-center align-middle">{{ $d->journal_detail->material_course}}</td>
                                
                                <td class="px-3 py-2 text-center align-middle flex space-x-1 justify-center">
                                    
                                    @if (($d->has_acc_student == 1) && !empty($d->sum_attendance_students))
                                    <button type="button" id="btn-verifikasi{{ $d->id }}" class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-1 text-center" onclick="openModalVerifikasi('{{ $d->id }}', '{{ route('m.dokumen_perkuliahan.verifikasi', $d->id) }}')">
                                        <i class="fa fa-check"></i> Verifikasi </button>
                                    @elseif(($d->has_acc_lecturer == 1) && empty($d->sum_attendance_students))
                                    Dosen Belum Mengisi Daftar Hadir
                                    @else
                                    <a href="{{ route('m.dokumen_perkuliahan.detail_verifikasi', ['id' => $d->id]) }}"  class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-1 text-center">
                                        <i class="fa fa-info"></i> Detail </a>
                                    @endif
                                    
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-3 text-center">Belum Ada Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div id="verifikasi-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                    <h2 class="text-lg font-semibold mb-4">Konfirmasi Verifikasi</h2>
                    <p class="mb-4">Apakah Anda yakin ingin Verifikasi data ini?</p>
                    <div class="flex justify-end">
                        <button id="cancel-button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2" onclick="closeModalVerifikasi()">Batal</button>
                        <button id="confirm-button" class="bg-green-600 text-white px-4 py-2 rounded-md" onclick="confirmVerifikasi()">Verifikasi</button>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        let verifikasiId = null;
        let verifikasiUrl = '';
    
        function openModalVerifikasi(id, url) {
            verifikasiId = id;
            verifikasiUrl = url;
            document.getElementById('verifikasi-modal').classList.remove('hidden');
        }
        function closeModalVerifikasi() {
            document.getElementById('verifikasi-modal').classList.add('hidden');
        }
    
        function confirmVerifikasi() {
            closeModalVerifikasi(); // Menutup modal
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = verifikasiUrl;
    
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'POST';
    
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit(); // Mengirimkan form
        }
        
    </script>


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
