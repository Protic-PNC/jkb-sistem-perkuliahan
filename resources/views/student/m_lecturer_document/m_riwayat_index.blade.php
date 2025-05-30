<x-app-layout>
    @section('main_folder', '/ Riwayat Absensi ')


    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">

            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Riwayat Kehadiran Mahasiswa</h3>
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
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
                                        <svg class="w-8 h-8 text-white" version="1.1" id="_x32_"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #000000;
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0"
                                                        d="M473.61,63.16L276.16,2.927C269.788,0.986,263.004,0,256.001,0c-7.005,0-13.789,0.986-20.161,2.927 L38.386,63.16c-3.457,1.064-5.689,3.509-5.689,6.25c0,2.74,2.232,5.186,5.691,6.25l91.401,27.88v77.228 c0.023,39.93,13.598,78.284,38.224,107.981c11.834,14.254,25.454,25.574,40.483,33.633c15.941,8.564,32.469,12.904,49.124,12.904 c16.646,0,33.176-4.34,49.126-12.904c22.597-12.143,42.04-31.646,56.226-56.39c14.699-25.683,22.471-55.155,22.478-85.224v-78.214 l45.244-13.804v64.192c-6.2,0.784-11.007,6.095-11.007,12.5c0,5.574,3.649,10.404,8.872,12.011l-9.596,63.315 c-0.235,1.576,0.223,3.168,1.262,4.386c1.042,1.204,2.554,1.902,4.148,1.902h36.273c1.592,0,3.104-0.699,4.148-1.91 c1.036-1.203,1.496-2.803,1.262-4.386l-9.596-63.307c5.223-1.607,8.872-6.436,8.872-12.011c0-6.405-4.81-11.716-11.011-12.5V81.544 l19.292-5.885c3.457-1.064,5.691-3.517,5.691-6.25C479.303,66.677,477.069,64.223,473.61,63.16z M257.62,297.871 c-10.413,0-20.994-2.842-31.448-8.455c-16.194-8.649-30.908-23.564-41.438-42.011c-4.854-8.478-8.796-17.702-11.729-27.445 c60.877-10.776,98.51-49.379,119.739-80.97c10.242,20.776,27.661,46.754,54.227,58.648c-3.121,24.984-13.228,48.812-28.532,67.212 c-8.616,10.404-18.773,18.898-29.375,24.573C278.606,295.029,268.025,297.871,257.62,297.871z">
                                                    </path>
                                                    <path class="st0"
                                                        d="M373.786,314.23l-1.004-0.629l-110.533,97.274L151.714,313.6l-1.004,0.629 c-36.853,23.036-76.02,85.652-76.02,156.326v0.955l0.846,0.45C76.291,472.365,152.428,512,262.249,512 c109.819,0,185.958-39.635,186.712-40.038l0.846-0.45v-0.955C449.808,399.881,410.639,337.265,373.786,314.23z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                                        <div class="text-gray-500">Kelas : {{ $student->student_class->study_program->name }} {{ $student->student_class->level }} {{ $student->student_class->name }}</div>
                                    </div>
                                </div>

                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                        <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                            <tr class="text-white mb-3">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                                <th scope="col" class="px-6 py-3">Jumlah Kehadiran</th>
                                <th scope="col" class="px-6 py-3 text-center">Persentase Kehadiran</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}
                                    </td>
                                    
                                    <td class="px-3 py-2 text-slate-800">{{ $d->course->name }}</td>
                                    <td class="px-3 py-2 text-slate-800">{{
                                        $d->attendanceListDetails
                                            ->flatMap(function ($detail) {
                                                return $detail->attendence_list_student;
                                            })
                                            ->count()
                                    }}
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        @php
                                            $totalPertemuan = $d->attendanceListDetails->count();

                                            $jumlahHadir = $d->attendanceListDetails
                                                ->flatMap(fn($detail) => $detail->attendence_list_student)
                                                ->count();

                                            $persentase = $totalPertemuan > 0
                                                ? round(($jumlahHadir / $totalPertemuan) * 100, 2)
                                                : 0;
                                        @endphp

                                        {{ $persentase }}%
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

