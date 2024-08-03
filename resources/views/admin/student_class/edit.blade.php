<x-app-layout>
    @section('name_page', 'Program Studi')

    @section('content')
        <div class="mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Tambah Kelas</h2>

                <form action="{{ route('admin.student_classes.update', $student_class) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-6 mt-6 mb-6 md:grid-cols-2 w-full">

                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">Nama
                                Kelas</label>
                            <input type="text" id="name" name="name" value="{{ $student_class->name }}"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-gray-700 dark:border-yellow-500">
                        </div>
                        <div>
                            <label for="academic_year"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">Tahun Masuk</label>
                            <select id="academic_year" name="academic_year"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-gray-700 dark:border-yellow-500">
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
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">Tahun
                                Akademik</label>
                            <select id="study_program_id" name="study_program_id"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-gray-700 dark:border-yellow-500">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodis as $study_program)
                                    <option value="{{ $study_program->id }}">{{ $study_program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit"
                                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @push('after-script')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var inputField = document.getElementById('academic_year');
                    var currentYear = new Date().getFullYear();
                    inputField.setAttribute('max', currentYear);
                });
            </script>
        @endpush
    @endsection

</x-app-layout>
