<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Program Studi')

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
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Program Studi</h2>
                <form action="{{ route('masterdata.study_programs.update', $study_program) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div >
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Program Studi</label>
                            <input type="text" name="name" id="name" value="{{ $study_program->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Nama Program Studi!" required="">
                        </div>

                        <div>
                            <label for="jenjang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenjang</label>
                            <select id="jenjang" name="jenjang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="{{ $study_program->jenjang }}">{{ $study_program->jenjang }}
                                </option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                            </select>
                        </div>

                    </div>
                    <button type="submit"
                        class="text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center">
                        Simpan
                    </button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
