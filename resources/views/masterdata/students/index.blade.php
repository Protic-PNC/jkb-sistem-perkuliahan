<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Mahasiswa')


    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">

            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Mahasiswa</h3>
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
                <div class="mb-3 flex items-center justify-between">
                    <div class="flex space-x-2">
                        <a href="{{ route('masterdata.students.create') }}" class="inline-block">
                            <button type="button"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Tambah Data
                            </button>
                        </a>
                         <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button"
                            class="px-5 py-2.5 mb-4 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Import
                            Data
                        </button>
                        {{-- <a href="javascript:void(0)" class="inline-block">
                            <button type="button" id="openImportModal"
                                class="text-white bg-teal-500 hover:bg-teal-600 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center">
                                <i class="fas fa-file-import mr-2"></i>
                                Import Data Kelas
                            </button> --}}
                        </a>

                    </div>
                    <form action="{{ route('masterdata.students.index') }}" method="GET" class="flex items-center">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input name="search" type="text" placeholder="Search" value="{{ request('search') }}"
                                class="w-32 pl-10 pr-4 py-2 rounded-md form-input sm:w-64 focus:border-indigo-600">
                        </div>

                        <button type="submit"
                            class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                            Search
                        </button>

                        @if (request('search'))
                            <a href="{{ route('masterdata.students.index') }}"
                                class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">NIM</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Alamat</th>
                                <th scope="col" class="px-6 py-3">No Telefon</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-2 text-slate-800">{{ $student->nim }}</td>
                                    <td class="px-3 py-2 text-slate-800">{{ $student->name }}</td>
                                    <td class="px-3 py-2 text-slate-800">{{ $student->address }}</td>
                                    <td class="px-3 py-2 text-slate-800">{{ $student->number_phone }}</td>
                                    <td class="px-3 py-2 text-slate-800">  {{ $student->student_class->study_program->name }} {{ $student->student_class->level }} {{ $student->student_class->name }}</td>
                                    <td class="px-3 py-2 flex space-x-2 justify-center ">
                                        <a href="{{ route('masterdata.students.edit', $student->id) }}"
                                            class="inline-flex items-center justify-center w-20 text-center font-medium bg-yellow-400 text-white px-3 py-2 rounded-md hover:bg-yellow-500 transition duration-300">
                                            <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button" id="btn-hapus{{ $student->id }}" class="font-medium bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition duration-300 hover:underline" onclick="openModal('{{ $student->id }}', '{{ route('masterdata.students.destroy', $student) }}')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-2 text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $students->appends(request()->query())->onEachSide(10)->links() }}
                </div>
                <!-- Modal -->
                <!-- Modal -->
                <div id="importModalOverlay"
                    class="fixed inset-0 z-40 hidden bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300 ease-in-out">
                </div>

                <div id="crud-modal" tabindex="-1" aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Import Mahasisiswa
            </h3>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-toggle="crud-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <a href="{{ route('masterdata.student_class.export') }}" id="btn-export"
            class="flex items-center gap-2 px-5 py-2.5 mb-4 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 m-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5 7.5 7.5-7.5M12 3v17.25" />
            </svg> Download Daftar Kelas </a>
          <a href="{{ route('masterdata.student.template') }}" id="btn-template"
            class="flex items-center gap-2 px-5 py-2.5 mb-4 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 m-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5 7.5 7.5-7.5M12 3v17.25" />
            </svg> Download Template Import</a>
          <form class="p-4 md:p-5" action="{{ route('masterdata.students.import') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 ">

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                file</label>
              <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                aria-describedby="file_import" id="file_import" name="file_import" type="file"
                accept=".xls,.xlsx">
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Upload file .xls atau .xslx
              </p>



            </div>
            <button type="submit"
              class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd"></path>
              </svg>
              Simpan
            </button>
          </form>
        </div>
      </div>
    </div>

            </div>
        </section>

        @push('after-script')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            <script>
                $(document).ready(function() {
                    // Open modal with animation
                    $('#openImportModal').on('click', function() {
                        $('#importModalOverlay').removeClass('hidden');
                        $('#importModal').removeClass('hidden');
                    });

                    // Close modal with animation
                    $('#closeModal, #cancelImport').on('click', function() {
                        $('#importModalOverlay').addClass('hidden');
                        $('#importModal').addClass('hidden');

                        setTimeout(function() {
                            $('#importModalOverlay').addClass('hidden');
                            $('#importModal').addClass('hidden');
                        }, 300); // Delay to allow animation to complete
                    });

                    // Handle form submission (you can add AJAX or other logic here)
                    $('#form-import-data-mahasiswa').on('submit', function(event) {
                        event.preventDefault();
                        const formData = new FormData(this); // 'this' mengacu pada form
                        $('.invalid-feedback').text('').hide();

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('masterdata.students.import') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $('#btn-simpan-import').attr('disabled', 'disabled');
                                $('#btn-simpan-import').html(
                                    '<i class="fa fa-spinner fa-spin mr-1"></i> Simpan');
                            },
                            complete: function() {
                                $('#btn-simpan-import').removeAttr('disabled');
                                $('#btn-simpan-import').html('<i class="fa fa-save"></i> Simpan');
                            },
                            success: function(response) {
                                console.log("Response dari server:", response);
                                $('#importModal').removeClass('md-show');

                                // Reset form di sini
                                $('#form-import-data-mahasiswa')[0].reset();
                            },
                            error: function(xhr) {
                                // const errors = xhr.responseJSON.errors;
                                // $.each(errors, function(key, value) {
                                //     $('#error-' + key).text(value[0]).show();
                                // });
                                console.error("Ada masalah:", response.message);
                            }
                        });
                    });

                });
            </script>


            <script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this user?');
                }
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        setTimeout(function() {
                            successMessage.style.opacity = '0';
                            setTimeout(function() {
                                successMessage.remove();
                            }, 500); // Time for fade-out transition
                        }, 3000); // Time to show message before fading out
                    }
                });
            </script>
        @endpush

    @endsection
</x-app-layout>
