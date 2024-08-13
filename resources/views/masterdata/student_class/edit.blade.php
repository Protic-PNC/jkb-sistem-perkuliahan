<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Kelas')

    @section('content')
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
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Kelas</h2>
                <form action="{{ route('masterdata.student_classes.update', $student_class) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kelas</label>
                            <input type="text" name="name" id="name" value="{{ $student_class->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Nama Kelas!" required="">
                        </div>
                        
                        <div>
                            <label for="academic_year"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Masuk</label>
                            <select id="academic_year" name="academic_year" value="{{ $student_class->academic_year }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @php
                                    $currentYear = date('Y');
                                    $startYear = 2018; // Start year for the dropdown
                                    $endYear = $currentYear; // Current year as the end year
                                @endphp
                        
                                @for ($year = $startYear; $year <= $endYear; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="study_program_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Program Studi</label>
                            <select id="study_program_id" name="study_program_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="{{ $student_class->id }}">{{ $student_class->name }}</option>
                                @foreach ($prodis as $study_program)
                                    <option value="{{ $study_program->id }}">{{ $study_program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tambah
                    </button>
                </form>
            </div>
        </section>

        
    @endsection

    @push('after-script')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var inputField = document.getElementById('academic_year');
                    var currentYear = new Date().getFullYear();
                    inputField.setAttribute('max', currentYear);
                });
            </script>
        @endpush
</x-app-layout>
