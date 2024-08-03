<x-app-layout>
    @section('name_page', 'Program Studi')

    @section('content')
        <div class="mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Edit Program Studi</h2>

                <form action="{{ route('admin.study_programs.update', $study_program) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-6 mt-6 mb-6 md:grid-cols-2 w-full">

                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">Nama Program Studi</label>
                            <input value="{{ $study_program->name }}" type="text" id="name" name="name" 
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-gray-700 dark:border-yellow-500"
                                >
                        </div>
                        <div>
                            <label for="jenjang"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">Jenjang</label>
                            <select id="jenjang" name="jenjang"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-gray-700 dark:border-yellow-500">
                                <option value="" disabled selected>Pilih Jenjang</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>
