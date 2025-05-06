<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Daftar Hadir')

    @section('content')

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                @if (session('error'))
    <div class="text-red-500 text-sm">
        {{ session('error') }}
    </div>
@endif
                {{-- @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Whoops!</span> There were some problems with your input.
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
@endif --}}

                
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Daftar Hadir</h2>
                <form action="{{ route('masterdata.lecturer_documents.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                       
                        <div class="w-full">
                            <label for="student_class_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select id="student_class_id" name="student_class_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Kelas</option>
                                @foreach ($student_classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->study_program->name }}  {{ $class->level }}  {{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="course_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mata Kuliah</label>
                            <select id="course_id" name="course_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Mata Kuliah</option>

                            </select>
                        </div>
                        <div class="w-full">
                            <label for="lecturer_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mata Kuliah</label>
                            <select id="lecturer_id" name="lecturer_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Dosen</option>

                            </select>
                        </div>
                        <div class="w-full">
                            <label for="periode_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periode</label>
                            <select id="periode_id" name="periode_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Periode</option>
                                @foreach ($periode as $p)
                                    <option value="{{ $p->id }}">{{ $p->tahun }} - {{ $p->semester }} </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div>
                            <label for="user_id" class="hidden">User</label>
                            <input type="text" id="user_id" name="user_id" value="{{ $user->id }}"
                                class="hidden">
                        </div> --}}

                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Tambah
                    </button>
                </form>
            </div>
        </section>

        <script>
            document.getElementById('student_class_id').addEventListener('change', function() {
                var classId = this.value;

                // Clear the previous options
                var courseSelect = document.getElementById('course_id');
                courseSelect.innerHTML = '<option value="" >Pilih Mata Kuliah</option>';

                // Make an AJAX request to fetch courses based on selected class
                if (classId) {
                    fetch('/masterdata/get-courses-by-class/' + classId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function(course) {
                                var option = document.createElement('option');
                                option.value = course.id;
                                option.textContent = course.name;
                                courseSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            document.getElementById('course_id').addEventListener('change', function() {
                var courseId = this.value;

                var lecturerSelect = document.getElementById('lecturer_id');
                lecturerSelect.innerHTML = '<option value="">Pilih Dosen</option>';

                if (courseId) {
                    fetch('/masterdata/get-lecturer-by-course/' + courseId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function(lecturer) {
                                var option = document.createElement('option');
                                option.value = lecturer
                                    .id;
                                option.textContent = lecturer
                                    .name;
                                lecturerSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        </script>
    @endsection
</x-app-layout>
