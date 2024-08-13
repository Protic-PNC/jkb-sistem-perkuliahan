<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Mahasiswa')

    @section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white dark:from-gray-900"></div>
        </div>
        
        <div class="px-8 pb-8 -mt-20 relative">
            <div class="flex flex-col md:flex-row items-center md:items-end mb-6 mt-24">
                <img src="{{ Storage::url($student->user->avatar) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 shadow-lg mb-4 md:mb-0 md:mr-6">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $student->name }}</h2>
                    <p class="text-xl text-gray-950 dark:text-gray-300">{{ $student->nim }}</p>
                </div>
            </div>

            <hr class="my-6 border-gray-200 dark:border-gray-700">

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-950 dark:text-gray-200 mb-2">Email</h3>
                <p class="text-gray-950 dark:text-gray-400">{{ $student->user->email }}</p>
            </div>

            <hr class="my-6 border-gray-200 dark:border-gray-700">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-950 dark:text-gray-200 mb-2">Alamat</h3>
                    <p class="text-gray-950 dark:text-gray-400">{{ $student->address }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-950 dark:text-gray-200 mb-2">No Telefon</h3>
                    <p class="text-gray-950 dark:text-gray-400">{{ $student->number_phone }}</p>
                </div>
            </div>

            <hr class="my-6 border-gray-200 dark:border-gray-700">

            <div class="flex flex-wrap justify-between items-center">
                <div class="flex space-x-3 mb-4 md:mb-0">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-950 rounded-lg hover:bg-gray-300 transition duration-300">
                        Preview
                    </button>
                </div>
                <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete
                </button>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>