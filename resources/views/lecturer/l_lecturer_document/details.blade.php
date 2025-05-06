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

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-slate-800">
                    
                    <table class="w-full border-collapse font-sans">
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
                                <td class="p-2">: {{ $semester }}</td>
                                <td class="p-2">Kelas</td>
                                <td class="p-2">: {{ $data->student_class->study_program->name }} {{ $data->student_class->level }} {{ $data->student_class->name }}</td>
                            </tr>
                            <tr>
                                <td class="p-2">Dosen</td>
                                <td class="p-2">: {{ $data->lecturer->name }}</td>
                                <td class="p-2">Tahun Akademik</td>
                                <td class="p-2">: {{ $academicYear }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="p-2">Jam Perkuliahan</td>
                                <td class="p-2">: {{ $data->course->hours }} Jam</td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="m-3 flex items-center justify-between">
                        <a href="{{ route('lecturer.lecturer_document.create', $data->id) }}" class="inline-block">
                            <button type="button"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 text-center">
                                Tambah Detail Pertemuan
                            </button>
                        </a>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4 border-collapse">
                        <thead class="text-xs uppercase bg-gray-900 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">Pertemuan Ke</th>
                                <th scope="col" class="px-6 py-3 text-center">Jumlah Mahasiswa Hadir</th>
                                <th scope="col" class="px-6 py-3 text-center">Status Pertemuan</th>
                                <th scope="col" class="px-6 py-3 text-center">Metode Pembelajaran</th>
                                <th scope="col" class="px-6 py-3 text-center">Materi Perkuliahan</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($details as $d)
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
                                <td class="px-6 py-4 text-center align-middle">
                                    @if($d->has_acc_student == 1)
                                    Belum DiVerifikasi Mahasiswa
                                    @elseif($d->has_acc_student == 2 && $d->journal_detail->has_acc_kaprodi == 1)
                                    Sudah Diverifikasi Mahasiswa Belum Diverifikasi Kaprodi
                                    @elseif ($d->has_acc_student == 2 && $d->journal_detail->has_acc_kaprodi == 2)
                                    Sudah Diverifikasi Mahasiswa dan Dosen
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center align-middle flex space-x-1 justify-center">
                                    
                                    <a href="{{ route('lecturer.lecturer_document.edit', $d->id) }}"
                                        class="inline-flex items-center justify-center  text-center font-medium bg-yellow-400 text-white px-2 py-1 rounded-md hover:bg-yellow-500 transition duration-300">
                                        <svg class="w-4 h-4 mr-1 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                        Edit Detail
                                    </a>
                                    <a href="{{ route('lecturer.lecturer_document.absensi', $d->id) }}" class="inline-block">
                                        <button type="button" class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-1 text-center">
                                            Isi Absensi
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
                    
                </div>
               @if ($details->count() > 3 && $data->has_finished == 1)
               
               <div class="m-3">      
                       <button type="button" id="btn-verifikasi{{ $data->id }}" class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-1 text-center" onclick="selesaiDocument({{ $data->id }})">
                           <i class="fa fa-check"></i> Perkuliahan Selesai</button>
               </div>
               @endif
                                    
            </div>
            <div id="Selesai-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                    <h2 class="text-lg font-semibold mb-4">Konfirmasi Selesai</h2>
                    <p class="mb-4">Apakah Daftar Hadir dan Jurnal Perkuliahan Telah Selesai?</p>
                    <div class="flex justify-end">
                        <button id="cancel-button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2" onclick="closeModalSelesai()">Batal</button>
                        <button id="confirm-button" class="bg-green-600 text-white px-4 py-2 rounded-md" onclick="confirmSelesai()">Selesai</button>
                    </div>
                </div>
            </div>
        </section>
        {{-- <script>
            let SelesaiId = null;
        let SelesaiUrl = '';
    
        function openModalSelesai(id, url) {
            SelesaiId = id;
            SelesaiUrl = url;
            document.getElementById('Selesai-modal').classList.remove('hidden');
        }
        function closeModalSelesai() {
            document.getElementById('Selesai-modal').classList.add('hidden');
        }
    
        function confirmSelesai() {
            closeModalSelesai(); // Menutup modal
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = SelesaiUrl;
    
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
        </script> --}}
        <script>
            function selesaiDocument(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menyelesaikan dokumen ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('lecturer.lecturer_document.selesai', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'POST'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let error = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                            Swal.fire(
                                'Gagal!',
                                error,
                                'error'
                            );
                        }
                    });
                }
            });
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
