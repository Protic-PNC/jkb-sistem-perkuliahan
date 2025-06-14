
<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Jabatan')


    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Jabatan</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
                </div>
                @if (session('success'))
                    <div id="success-message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                @endif
                <div class="mb-3 flex items-center justify-between">
                    <a href="{{ route('masterdata.positions.create') }}" class="inline-block">
                        <button type="button"
                            class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Tambah Data
                        </button>
                    </a>

                   
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $a)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-2 text-slate-800">{{ $a->name }} @if($a->prodis)  
                                        {{ $a->prodis->name }}  
                                    @else  
                                        
                                    @endif </td>
                                    
                                    <td class="px-3 py-2 flex space-x-2 justify-center ">
                                        <a href="{{ route('masterdata.positions.edit', $a->id) }}"
                                            class="inline-flex items-center justify-center w-20 text-center font-medium bg-yellow-400 text-white px-3 py-2 rounded-md hover:bg-yellow-500 transition duration-300">
                                            <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        
                                        <button type="button" id="btn-hapus{{ $a->id }}" class="font-medium bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition duration-300 hover:underline" onclick="openModal('{{ $a->id }}', '{{ route('masterdata.positions.destroy', $a->id) }}')">
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
                    {{ $data->appends(request()->query())->onEachSide(5)->links() }}
                </div>
            </div>
        </section>
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
    @endsection
</x-app-layout>
