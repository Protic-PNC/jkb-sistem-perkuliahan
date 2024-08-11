<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Mahasiswa')

    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto max-w-4xl lg:py-8">
                @if (session('succes'))
                    <div id="success-message"
                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('succes') }}
                    </div>
                @endif
                <div class="mb-3">
                    <a href="{{ route('masterdata.student_classes.create') }}">
                        <button type="button"
                            class="text-white bg-gradient-to-r from-indigo-500 via-indigo-600 to-indigo-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-indigo-300  dark:focus:ring-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Mahasiswa</button>
                    </a>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white">
                                    NO
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    NIM
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Alamat
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Tanda Tangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    No Telp
                                </th>
                                <th scope="col" class="px-6 py-3 text-white">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-white text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $student->nim }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->address}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->signature}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->number_phone}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->user->email}}
                                    </td>
                                    <td class="px-6 py-4 text-slate-800">
                                        <div class="flex space-x-2 justify-center">
                                            <a href="{{ route('masterdata.student.edit', $student->id) }}"
                                                class="inline-block w-20 text-center font-medium bg-indigo-600 text-white px-3 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('masterdata.students.destroy', $student->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium  bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition duration-300 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @push('scripts')
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
