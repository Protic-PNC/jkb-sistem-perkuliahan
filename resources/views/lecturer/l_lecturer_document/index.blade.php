<x-app-layout>
    @section('main_folder', '/ Dokumen Perkuliahan')
    @section('descendant_folder', '/ Kelola')


    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">

            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                {{-- <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Mata Kuliah Yang Diampu</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
                </div>
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
                @endif --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Kelola Dokumen Perkuliahan</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
                </div>
                <div class="mb-3 flex items-center justify-between">
                    

                    <form action="{{ route('d.dokumen_perkuliahan', Auth::user()->lecturer->nidn) }}" method="GET" class="flex items-center">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input name="search" type="text" placeholder="Search" value="{{ request('search') }}"
                                class="w-32 pl-10 pr-4 py-2 rounded-md form-input sm:w-64 focus:border-indigo-600">
                        </div>

                        <button type="submit"
                            class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                            Search
                        </button>

                        @if (request('search'))
                            <a href="{{ route('masterdata.lecturer_documents.index') }}"
                                class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                                <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                                <th scope="col" class="px-6 py-3 text-center">Pilih Perkuliahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-2 text-slate-800">{{ $d->student_class->study_program->name }} {{ $d->student_class->level }} {{ $d->student_class->name }} </td>
                                    <td class="px-3 py-2 text-slate-800">{{ $d->course->name }}</td>
                                    
                                    <td class="px-3 py-2 flex space-x-2 justify-center ">
                                        <a href="{{ route('d.dokumen_perkuliahan.details', $d->id) }}"
                                            class="inline-block text-center font-medium bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                                            Pilih Dokumen
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-2 text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $courses->appends(request()->query())->onEachSide(5)->links() }} --}}
                </div>
            </div>
        </section>

        @push('after-script')
            <script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this user?');
                }
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        setTimeout(function() {
                            successMessage.style.opacity = '0';
                            setTimeout(function() {
                                successMessage.remove();
                            }, 500); // Time for fade-out transition
                        }, 3000); // Time to show message before fading out
                    }
                });
            </script>
        @endpush

    @endsection
</x-app-layout>

