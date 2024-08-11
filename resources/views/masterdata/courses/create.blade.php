<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Mata Kuliah')

    @section('content')

        <section class="bg-white dark:bg-gray-900">
            @if (session('error'))
                <div class="alert alert-danger">
                    <p class="py-5 bg-red-500 text-white font-bold">{{ session('error') }}</p>
                </div>
            @endif
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Mata Kuliah</h2>
                <form action="{{ route('masterdata.courses.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Mata Kuliah</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Nama Mata Kuliah" required="">
                        </div>
                        <div class="w-full">
                            <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                Mata Kuliah</label>
                            <input type="text" name="code" id="code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Kode Matakuliah" required="">
                        </div>
                        <div class="w-full">
                            <div>
                                <label for="type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Mata
                                    Kuliah</label>
                                <select id="type" name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled selected>Pilih type</option>
                                    <option value="praktikum">Praktikum</option>
                                    <option value="teori">Teori</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="sks"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKS</label>
                            <input type="number" name="sks" id="sks"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Jumlah SKS" required="">
                        </div>
                        <div class="w-full">
                            <label for="hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                Perkuliahan</label>
                            <input type="number" name="hours" id="hours"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Jumlah Jam Perkuliahan" required="">
                        </div>

                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Tambah
                    </button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
