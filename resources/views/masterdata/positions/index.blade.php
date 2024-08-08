<x-app-layout>
    @section('name_page', 'Hallo')
    @section('name_main', 'Jabatan')

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
        <!-- Card for Add Button -->
        

        <!-- Card for Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-3">
                <a href="{{ route('masterdata.positions.create') }}">
                    <button type="button" class="text-white bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300  dark:focus:ring-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Jabatan</button>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                    <thead class="text-xs text-gray-700 uppercase bg-yellow-500 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-white">
                            <th scope="col" class="px-6 py-3">
                                No 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $position)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4 text-slate-800">
                                {{ $position->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-800">
                                <a href="{{ route('masterdata.positions.edit', $position->id) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('masterdata.positions.destroy', $position->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">Belum Ada Data Jabatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
