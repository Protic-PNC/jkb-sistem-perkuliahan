<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Daftar Hadir')

    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
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

                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Error!</span> {{ session('error') }}
                    </div>
                @endif
                @if (!$attendance)
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Daftar Hadir</h2>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                            <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                                <tr class="text-white mb-3">
                                    <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                                    <th scope="col" class="px-6 py-3">Absensi</th>
                                    <th scope="col" class="px-6 py-3 ">Keterlambatan</th>
                                    <th scope="col" class="px-6 py-3 ">Catatan</th>
                                </tr>
                            </thead>
                            <tbody id="studentList">
                                <form id="form2" action="{{ route('d.dokumen_perkuliahan.storeStudents') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" id="attendance_list_detail_id" name="attendance_list_detail_id"
                                        value="{{ $ad->id }}">
                                    @foreach ($student_classes as $student)
                                        <tr>
                                            <td class="px-6 py-4">{{ $student->name }}</td>
                                            <td class="px-6 py-4">
                                                <input type="hidden" name="attendance[{{ $student->id }}][student_id]"
                                                    value="{{ $student->id }}">
                                                <label style="display: inline-block; margin-right: 10px;">
                                                    <input type="radio"
                                                        name="attendance[{{ $student->id }}][attendance_student]"
                                                        value="1">
                                                    Hadir
                                                </label>
                                                <label style="display: inline-block; margin-right: 10px;">
                                                    <input type="radio"
                                                        name="attendance[{{ $student->id }}][attendance_student]"
                                                        value="2">
                                                    Telat
                                                </label>
                                                <label style="display: inline-block; margin-right: 10px;">
                                                    <input type="radio"
                                                        name="attendance[{{ $student->id }}][attendance_student]"
                                                        value="3">
                                                    Sakit
                                                </label>
                                                <label style="display: inline-block; margin-right: 10px;">
                                                    <input type="radio"
                                                        name="attendance[{{ $student->id }}][attendance_student]"
                                                        value="4">
                                                    Izin
                                                </label>
                                                <label style="display: inline-block; margin-right: 10px;">
                                                    <input type="radio"
                                                        name="attendance[{{ $student->id }}][attendance_student]"
                                                        value="5">
                                                    Bolos
                                                </label>
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="number" name="attendance[{{ $student->id }}][minutes_late]"
                                                    id="minutes_late"
                                                    class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg 
                                            focus:ring-primary-600 focus:border-primary-600 
                                            dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                                            dark:focus:ring-primary-500 dark:focus:border-primary-500 w-full">
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="text" name="attendance[{{ $student->id }}][note]"
                                                    id="note"
                                                    class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg 
                                                          focus:ring-primary-600 focus:border-primary-600 
                                                          dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                                                          dark:focus:ring-primary-500 dark:focus:border-primary-500 w-full">
                                            </td>
                                        </tr>
                                    @endforeach

                            </tbody>

                        </table>
                        <button type="submit" id="submitAttendanceDetails"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Simpan
                        </button>
                        </form>
                    </div>
                @else
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Hadir Tersimpan</h2>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-900 text-white">
                                <tr class="text-white mb-3">
                                    <th scope="col" class="px-6 py-3">NO</th>
                                    <th scope="col" class="px-6 py-3">NIM</th>
                                    <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                                    <th scope="col" class="px-6 py-3">Absensi</th>
                                    <th scope="col" class="px-6 py-3 ">Keterlambatan</th>
                                    <th scope="col" class="px-6 py-3 ">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">{{ $attendance->student->nim }}</td>
                                        <td class="px-6 py-4">{{ $attendance->student->name }}</td>
                                        <td class="px-6 py-4">
                                            @if ($attendance->attendance_student == 1)
                                                Hadir
                                            @elseif ($attendance->attendance_student == 2)
                                                Terlambat
                                            @elseif($attendance->attendance_student == 3)
                                                Sakit
                                            @elseif($attendance->attendance_student == 4)
                                                Izin
                                            @elseif($attendance->attendance_student == 5)
                                                Bolos
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($attendance->attendance_student == 2)
                                                {{ $attendance->minutes_late }} Menit
                                            @else
                                                Tidak Terlambat
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($attendance->note == null)
                                                Tidak ada catatan
                                            @else
                                                {{ $attendance->note }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('d.dokumen_perkuliahan.edit_student', $ad->id) }}"
                            class="inline-flex items-center justify-center  text-center font-medium bg-yellow-400 text-white px-3 py-2 rounded-md hover:bg-yellow-500 transition duration-300 mt-3">
                            <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                            Edit Absensi
                        </a>
                
                        @endif
            </div>
        </section>

        <script>
            document.querySelectorAll('input[type=radio][name^="attendance"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var studentId = this.name.match(/\[(.*?)\]/)[1]; // Mendapatkan student_id dari nama radio
                    var minutesLateInput = document.querySelector('input[name="attendance[' + studentId +
                        '][minutes_late]"]');

                    if (this.value == '2') { // Jika nilai radio button adalah 2 (Telat)
                        minutesLateInput.disabled = false;
                        minutesLateInput.required = true; // Menambahkan atribut required
                    } else {
                        minutesLateInput.value = ''; // Mengosongkan nilai jika radio selain "Telat" dipilih
                        minutesLateInput.disabled = true;
                        minutesLateInput.required = false;
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input[type=radio][name^="attendance"]').forEach(function(radio) {
                    radio.dispatchEvent(new Event(
                        'change'));
                });
            });

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
    @endsection
</x-app-layout>
