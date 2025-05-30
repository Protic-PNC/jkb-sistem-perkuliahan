<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ jadwal')


    @section('content')
        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">

                <h1
                    class="mb-4 text-l font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl dark:text-white">
                    Jadwal</h1>
                    @if (session('success'))
                    <div id="success-message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                @endif
                {{-- <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" id="btn-tambah"
                    class="px-5 py-2.5 mb-4 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
                    Data</button> --}}
                {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                           
                                <th scope="col" class="px-6 py-3">
                                    Tahun
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Semester
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Batas Awal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Batas Akhir
                                </th>
                                
                                <th scope="col" class="px-6 py-3 ">
                                    Aksi
                                </th>
                        </thead>
                        <tbody>
                            @forelse ($data as $a)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $a->tahun }}
                                    </td>
                                    <td scope="row"
                                        class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $a->semester }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ \Carbon\Carbon::parse($a->tanggal_batas_awal)->translatedFormat('j F Y') }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ \Carbon\Carbon::parse($a->tanggal_batas_akhir)->translatedFormat('j F Y') }}
                                    </td>
                                    
                                    <td class="px-3 py-2 text-right">
                                        <button type="button" data-modal-target="crud-modal"
                                            data-modal-toggle="crud-modal" data-id="{{ $a->id }}"
                                            class="edit-btn inline-flex items-center justify-center w-20 text-center font-medium bg-yellow-400 text-white px-3 py-2 rounded-md hover:bg-yellow-500 transition duration-300">Edit</button>

                                        <button type="button" id="btn-hapus{{ $a->id }}"
                                            class="font-medium bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition duration-300 hover:underline"
                                            onclick="openModal('{{ $a->id }}', '{{ route('masterdata.jadwal.destroy', $a->id) }}')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>

                                    </td>
                                </tr>
                            @empty
                            @endforelse


                        </tbody>
                    </table>
                </div> --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Program Studi
                                </th>
                               
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $a)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td scope="row"
                                        class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $a->name }}
                                    </td>
                                   
                                    
                                    
                                    <td class="px-3 py-2 text-right">
                                        <button type="button" data-modal-target="crud-modal"
                                            data-modal-toggle="crud-modal" data-id="{{ $a->id }}"
                                            class="edit-btn inline-flex items-center justify-center w-24 h-10 text-center font-medium bg-yellow-400 text-white px-3 py-2 rounded-md hover:bg-yellow-500 transition duration-300 mr-2"><i class="fa fa-edit mr-2"></i>Input</button>
                                            
                                            @if(!empty($a->jadwal->file))
                                            <a  href="{{ route('jadwal.download',$a->jadwal->id) }}" data-id="{{ $a->jadwal->id }}"
                                            class="inline-flex items-center justify-center w-24 h-10 text-center font-medium bg-green-400 text-white px-3 py-2 rounded-md hover:bg-green-500 transition duration-300 mr-2"><i class="fa fa-download mr-2"></i>Download</a>
                                            @endif
                                       

                                        

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-2 text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $data->appends(request()->query())->onEachSide(5)->links() }} --}}
                </div>
            </div>
        </section>



        

        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit jadwal
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form class="p-4 md:p-5" action="#" method="POST" id="editForm" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 ">
                        <input type="hidden" id="userid" name="userid">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_jadwal" id="file_jadwal" name="file_jadwal"  type="file" accept=".xlsx, .xls">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Upload File </p>

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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <script>
            let deleteId = null;
            let deleteUrl = '';

            function openModal(id, url) {
                deleteId = id;
                deleteUrl = url;
                document.getElementById('delete-modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('delete-modal').classList.add('hidden');
            }

            function confirmDelete() {
                closeModal(); // Menutup modal
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit(); // Mengirimkan form
            }
        </script>
        <script>
            $(document).ready(function() {
                let isEditMode = false;
                $(".btn-tambah").on("click", function() {
                    isEditMode = false;
                    $("#crud-modal").removeClass("hidden");

                });
                $(".edit-btn").on("click", function() {
                    let id = $(this).data("id");
                    const url = "{{ route('masterdata.jadwal.edit', ':id') }}".replace(":id", id);

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json", // Pastikan response diparsing sebagai JSON
                        success: function(response) {
                            if (response.prodi) {
                                $("#userid").val(id);
                                
                                $("#crud-modal").removeClass("hidden"); // Tampilkan modal
                            } else {
                                alert("Data tidak ditemukan!");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", xhr.responseText);
                            alert("Gagal mengambil data! " + xhr.responseText);
                        },
                    });
                    

                });
                $('#editForm').on('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        const id = $('#userid').val();
                       const url = "{{ route('jadwal.update', ['id' => ':id']) }}".replace(':id', id);
                        $('.invalid-feedback').text('').hide();
                        $.ajax({
                            type: 'POST', // Tetap pakai POST, tapi kita spoof PUT dengan _method
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                // $('#btn-simpan').attr('disabled', 'disabled');
                                // $('#btn-simpan').html(
                                //     '<i class="fa fa-spinner fa-spin mr-1"></i> Simpan');
                            },
                            complete: function() {
                                // $('#btn-simpan').removeAttr('disabled');
                                // $('#btn-simpan').html('<i class="fa fa-save"></i> Simpan');
                            },
                            success: function(response) {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data jadwal berhasil diperbarui.',
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                                $('#crud-modal').addClass('hidden');

                                location.reload();
                            },

                        });
                    });
                

            });
        </script>

    @endsection
</x-app-layout>
