<x-app-layout>
    @section('name_page', 'Program Studi')
    @section('name_main', 'Tambah Program Studi')

    @section('content')

        <form action="{{ route('admin.study_programs.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mt-6 mb-6 md:grid-cols-2 w-52">

                <div>
                    <input type="text" id="name" name="name"
                        class="bg-indigo-50 border border-indigo-500 text-indigo-900 dark:text-indigo-400 placeholder-indigo-700 dark:placeholder-indigo-500 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-indigo-500"
                        placeholder="Masukan Program Studi!">
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-32 sm:w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
            </div>
        </form>

    @endsection
</x-app-layout>
