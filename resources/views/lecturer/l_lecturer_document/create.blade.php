<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Daftar Hadir')

    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>
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

                @if (session('success'))
                    <div id="success-message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Error!</span> {{ session('error') }}
                    </div>
                @endif

                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Daftar Hadir</h2>
                <form id="form1" action="{{ route('lecturer.lecturer_document.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="meeting_order"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertemuan Ke</label>
                            <select id="meeting_order" name="meeting_order"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Pertemuan</option>
                                @for ($i = 1; $i <= $al->course->meeting; $i++)
                                    @if (!in_array($i, $selectedMeetings))
                                        <option value="{{ $i }}">Pertemuan ke {{ $i }}</option>
                                    @endif
                                @endfor

                            </select>
                        </div>
                        <div class="w-full">
                            <label for="course_status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                Pertemuan</label>
                            <select id="course_status" name="course_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Status Pertemuan</option>
                                <option value="1">Sesuai jadwal</option>
                                <option value="2">Pertukaran</option>
                                <option value="3">Pengganti</option>
                                <option value="4">Tambahan</option>

                            </select>
                        </div>
                        <div class="w-full">
                            <label for="meeting_hour"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Perkuliahan</label>
                            <div class="flex items-center">
                                <!-- Start Hour Select -->
                                <select id="start_hour" name="start_hour"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Pilih Jam Mulai</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>

                                <!-- "s/d" Label -->
                                <span class="mx-2">s/d</span>

                                <!-- End Hour Select -->
                                <select id="end_hour" name="end_hour"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Pilih Jam Selesai</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>


                        <div class="w-full">
                            <label for="material_course"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pokok Bahasan</label>
                            <input type="text" name="material_course" id="material_course"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Isi Materi Pada Pertemuan Ini" required="">
                        </div>
                        <div class="w-full">
                            <label for="learning_methods"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                Pertemuan</label>
                            <select id="learning_methods" name="learning_methods"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Metode Pembelajaran</option>
                                <option value="Offline">Ofline</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="submitAttendanceDetails"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Tambah
                    </button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
