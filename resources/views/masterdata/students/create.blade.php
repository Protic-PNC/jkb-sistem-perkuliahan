

<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ mahasiswa')

    @section('content')

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">Whoops!</span> Ada beberapa masalah dengan input Anda.
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Mahasiswa</h2>
                <form action="{{ route('masterdata.students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                                 @error('name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror

                        </div>
                        <div class="w-full">
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="number" name="nim" id="nim" placeholder="Masukan Maksimal 9 Angka"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="w-full">
                            <label for="signature" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanda Tangan</label>
                            <input type="file" id="signature" name="signature" accept=".png,.jpg,.jpeg" 
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                           
                        </div>
                        
                        <div class="w-full">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required=""> </textarea>
                        </div>
                        <div class="w-full">
                            <label for="number_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor HP</label>
                            <input type="number" name="number_phone" id="number_phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div>
                            <label for="student_class_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select id="student_class_id" name="student_class_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Kelas</option>
                                
                                @foreach ($student_class as $sclass)
                                    <option value="{{ $sclass->id }}"> {{ $sclass->study_program->name }} {{ $sclass->level }} {{ $sclass->name }}</option>
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
        </section>
    @endsection
</x-app-layout>
