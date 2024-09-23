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

                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Daftar Hadir</h2>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                                <th scope="col" class="px-6 py-3">Absensi</th>
                                <th scope="col" class="px-6 py-3 text-center">Keterlambatan</th>
                                <th scope="col" class="px-6 py-3 text-center">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="studentList">
                            <form id="form2" action="{{ route('lecturer.lecturer_document.storeStudents') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" id="attendance_list_detail_id" name="attendance_list_detail_id"
                                    value="{{ $al->id }}">
                                @foreach ($student_classes as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>
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
                                        <td class="px-6 py-4 text-center flex justify-center items-center">
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
                        Tambah
                    </button>
                    </form>
                </div>
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
