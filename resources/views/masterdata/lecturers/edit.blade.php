

<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Dosen')

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
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Dosen</h2>
                <form action="{{ route('masterdata.lecturers.update', $lecturer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $lecturer->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>
                        <div class="w-full">
                            <label for="nidn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIDN</label>
                            <input type="text" name="nidn" id="nidn" value="{{ $lecturer->nidn }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>
                        <div>
                            <label for="signature" class="block mb-2 text-sm font-medium text-gray-700">Upload
                                Tanda Tangan</label>
                            <input type="file" id="signature" name="signature"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                <img class="h-10 w-10" src="{{ Storage::url($lecturer->signature) }}" alt="">
                        </div>
                        <div class="w-full">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">address</label>
                            <textarea type="text" name="address" id="address"  
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required=""> {{ $lecturer->address }}</textarea>
                        </div>
                        <div class="w-full">
                            <label for="number_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">number_phone</label>
                            <input type="text" name="number_phone" id="number_phone" value="{{ $lecturer->number_phone }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="w-full">
                            <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ $lecturer->nip }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>
                        <div>
                            <label for="user_id" class="hidden">User</label>
                            <input type="text" id="user_id" name="user_id" value="{{ $lecturer->user->id }}"
                                class="hidden">
                        </div>

                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Edit
                    </button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
