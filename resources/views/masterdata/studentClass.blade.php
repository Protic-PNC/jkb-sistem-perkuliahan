<x-app-layout>
    @section('name_page', 'Hallo')
    @section('name_main', 'Kelas')

    @section('search')
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                <path
                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </span>

        <input class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-yellow-600" type="text"
            placeholder="Search">
    @endsection

    @section('content')

        <div class="mx-auto p-6">
            <!-- Card for Table -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-3">
                    <button id="createButton" data-modal-target="createModal" data-modal-toggle="createModal"
                        class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        type="button">
                        Tambah Kelas
                    </button>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs text-gray-700 uppercase bg-yellow-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white">
                                    NO
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Tahun Akademik
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Prodi
                                </th>
                                <th scope="col" class="px-6 py-3 text-white text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($studentClasses as $student_class)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $student_class->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student_class->academic_year }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student_class->study_program->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2 justify-center">
                                            {{-- <a href="{{ route('masterdata.student_classes.edit', $student_class->id) }}"
                                                class="inline-block w-20 text-center font-medium bg-yellow-600 text-white px-3 py-2 rounded-md hover:bg-yellow-700 transition duration-300">Edit</a> --}}
                                            <button id="updateButton" data-modal-target="updateModal"
                                                data-modal-toggle="updateModal"
                                                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                type="button">
                                                Edit Kelas
                                            </button>
                                            <form action="{{ route('masterdata.student_classes.destroy', $student_class->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium  bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition duration-300 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">Belum Ada Kelas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section Create start --}}
        <div id="createModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Kelas
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="updateModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('masterdata.student_classes.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Kelas</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukan Nama Kelas!" required="">
                            </div>

                            <div>
                                <label for="academic_year"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Masuk</label>
                                <select id="academic_year" name="academic_year"
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
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Program
                                    Studi</label>
                                <select id="study_program_id" name="study_program_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled selected>Pilih Prodi</option>
                                    @foreach ($prodis as $study_program)
                                        <option value="{{ $study_program->id }}">{{ $study_program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" 
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </section>

        {{-- Section Create end --}}


        {{-- Section Edit --}}
        <div class="flex justify-center m-5"></div>

        <!-- Main modal -->
        <div id="updateModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Class
                        </h3>
                        <a href="{{ route('masterdata.student_classes.index') }}"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="updateModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </a>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('masterdata.student_classes.update', $student_class) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kelas</label>
                                <input type="text" name="name" id="name" value="{{ $student_class->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Ex. Apple iMac 27&ldquo;">
                            </div>
                            <div>
                                <label for="academic_year"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">academic_year</label>
                                <select id="academic_year" name="academic_year"
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
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Program
                                    Studi</label>
                                <select id="study_program_id" name="study_program_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="{{ $student_class->study_program->id }}">
                                        {{ $student_class->study_program->name }}</option>
                                    @foreach ($prodis as $study_program)
                                        <option value="{{ $study_program->id }}">{{ $study_program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Edit
                            </button>
                            <button type="button"
                                class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
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
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    document.getElementById('updateButton').click();
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    document.getElementById('createButton').click();
                });
            </script>
        @endpush

    @endsection
</x-app-layout>
