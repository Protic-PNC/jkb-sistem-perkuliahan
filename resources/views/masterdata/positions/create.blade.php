<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Jabatan')

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
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Jabatan</h2>
                <form action="{{ route('masterdata.positions.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        
                        <div>  
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">  
                                Jabatan  
                            </label>  
                            <select id="name" name="name"   
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg   
                                           focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5   
                                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400   
                                           dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">  
                                <option value="" disabled selected>Pilih Jabatan</option>  
                                <option value="Kepala Jurusan">Kepala Jurusan Komputer dan Bisnis</option>  
                                <option value="Sekretaris Jurusan">Sekretaris Jurusan Komputer dan Bisnis</option>  
                                <option value="Koordinator Program Studi">Koordinator Program Studi</option>  
                            </select>  
                        </div>  
                          
                        <div id="prodi-container" style="display: none;">  
                            <label for="prodi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">  
                                Program Studi  
                            </label>  
                            <select id="prodi_id" name="prodi_id"   
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg   
                                           focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5   
                                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400   
                                           dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">  
                                <option value="" disabled selected>Pilih Program Studi</option>  
                                @foreach ($prodis as $prodi)  
                                    <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>  
                                @endforeach  
                            </select>  
                        </div>  
                        
                        
                        
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Simpan
                    </button>
                </form>
            </div>
            <script>  
                document.addEventListener('DOMContentLoaded', function() {  
                    const jabatanSelect = document.getElementById('name');  
                    const prodiContainer = document.getElementById('prodi-container');  
              
                    jabatanSelect.addEventListener('change', function() {  
                        if (jabatanSelect.value === 'Koordinator Program Studi') {  
                            prodiContainer.style.display = 'block'; // Show the prodi_id dropdown  
                        } else {  
                            prodiContainer.style.display = 'none'; // Hide the prodi_id dropdown  
                        }  
                    });  
                });  
            </script>  
        </section>
    @endsection
</x-app-layout>
