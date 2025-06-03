<x-app-layout>
    @section('main_folder', '/ Dokumen Perkuliahan')
    @section('descendant_folder', '/ Daftar Persetujuan')


    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">

            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    @if($jabatan->name == 'Kepala Jurusan') 
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Persetujuan Dokumen Daftar Hadir dan Jurnal Perkuliahan Jurusan Komputer dan Bisnis</h3>
                    @else
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Mata Kuliah Program Studi {{ $jabatan->prodis->name }}</h3>
                    @endif
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
                @endif

                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                                <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                                <th scope="col" class="px-6 py-3">Tanggal Selesai</th>
                                @if (Auth::user()->lecturer->position->name == 'Kepala Jurusan')
                                <th scope="col" class="px-6 py-3">Status</th>
                                @endif
                                
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
                                    <td class="px-3 py-2 text-slate-800">{{\Carbon\Carbon::parse($d->date_finished)->translatedFormat('j F Y') }}</td>
                                    
                                    @if (Auth::user()->lecturer->position->name == 'Kepala Jurusan')
                                    <td>
                                        @if ($d->has_acc_kajur == 2)
                                    <b> Sudah Disetujui Kepala Jurusan </b> Tanggal : {{\Carbon\Carbon::parse($d->date_acc_kajur)->translatedFormat('j F Y') }}
                                        @else
                                    Belum Disetujui Kepala Jurusan
                                        @endif
                                        </td>
                                    @endif
                                    
                                    
                                    
                                    <td class="px-3 py-2 flex space-x-2 justify-center ">
                                        
                                        <a href="{{ route('d.daftar_persetujuan_dokumen.detail', $d->id) }}"
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

