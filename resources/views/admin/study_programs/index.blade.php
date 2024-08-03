<x-app-layout>
    
    @section('name_page', 'Hallo')
    @section('name_main', 'Program Studi')
    @section('search')
    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
            <path
                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            </path>
        </svg>
    </span>
    
    <input class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text"
        placeholder="Search">
    @endsection
    
        @section('content')
        <a href="{{ route('admin.study_programs.create') }}">
        <button type="button"  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah Program Studi</button></a>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-white">
                            ID 
                        </th>
                        <th scope="col" class="px-6 py-3 text-white">
                            Nama 
                        </th>
                       
                        <th scope="col" class="px-6 py-3 text-white">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody >
                    @forelse ($prodis as $prodi)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $prodi->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $prodi->name }}
                        </td>
                        
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <p>Belum Ada Prodi</p>
                        
                    @endforelse
                </tbody>
            </table>
            
        </div>

        @endsection
    
    </div>
    
</x-app-layout>

