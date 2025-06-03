<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    @section('content')
        <div class="container px-6 py-8 mx-auto">
            <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
            <div class="bg-white dark:bg-gray-900 rounded-sm">
                <div class="py-4 px-2 mx-auto lg:m-4 sm:m-2">
                    <div class="text-2xl font-semibold text-gray-600"> Selamat Datang, {{ Auth::user()->name }}!</div>
                </div>
                 @role('dosen')
        <p class="font-medium text-gray-900 m-4">Daftar Mata Kuliah Yang Diampu</p>
                <div class="m-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
            <thead class="text-xs uppercase bg-gray-900 dark:text-gray-400">
                <tr class="text-white">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Mata Kuliah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auth->lecturer?->course as $d)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-slate-800">{{ $d->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-3 text-center text-gray-500">Belum Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
                </div>
        
        @endrole

        @role('mahasiswa')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 px-4">
            <div class="">
                <h3 class="text-lg font-semibold text-gray-950 dark:text-gray-200 mb-2">
                    Jadwal Program Studi {{ $jadwal->prodi->name ?? '-' }}
                </h3>
                <p class="text-gray-950 dark:text-gray-400">
                    {{-- Tambahkan detail jadwal jika diperlukan --}}
                </p>
            </div>

            <div class="">
                <h3 class="text-lg font-semibold text-gray-950 dark:text-gray-200 mb-2">File</h3>
                <p class="text-gray-950 dark:text-gray-400 p-5">
                    @if(isset($jadwal) && !empty($jadwal->file))
                        <a href="{{ route('jadwal.download', $jadwal->id) }}"
                           class="inline-flex items-center justify-center w-auto h-10 text-center font-medium bg-green-400 text-white px-4 py-2 rounded-md hover:bg-green-500 transition duration-300">
                            <i class="fa fa-download mr-2"></i>Download
                        </a>
                    @else
                        <span class="text-sm text-gray-500">Tidak ada file tersedia</span>
                    @endif
                </p>
            </div>
        </div>
        @endrole
                @role('super_admin')
                    <div class="mt-4">
                        <div class="flex flex-wrap -mx-6">
                            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md m-2">
                                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                        <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>

                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">{{ $user }}</h4>
                                        <div class="text-gray-500">Pengguna</div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">

                                        <svg class="w-8 h-8 text-white" fill="#000000" viewBox="0 0 64 64"
                                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                            version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="ICON">
                                                    <path
                                                        d="M60,3.5l-56,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1l2.171,-0c-0.111,0.313 -0.171,0.649 -0.171,1l-0,10.176c-0,0.552 0.448,1 1,1c0.552,0 1,-0.448 1,-1l0,-6.676l44,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-44,-0l0,-1.5c0,-0.552 0.448,-1 1,-1l46,-0c0.552,-0 1,0.448 1,1c0,0 -0,30.5 -0,30.5c-0,0.552 -0.448,1 -1,1l-23,-0l-0,-10.25c-0,-6.075 -4.925,-11 -11,-11c-0.665,0 -1.335,0 -2,0c-6.075,0 -11,4.925 -11,11l0,17.542c-1.104,0.329 -2.12,0.929 -2.95,1.758c-1.313,1.313 -2.05,3.093 -2.05,4.95c0,3.799 0,8 0,8c0,0.552 0.448,1 1,1l32,-0c0.552,-0 1,-0.448 1,-1l-0,-8c0,-1.857 -0.737,-3.637 -2.05,-4.95c-0.83,-0.829 -1.846,-1.429 -2.95,-1.758l-0,-5.292l23,0c1.657,-0 3,-1.343 3,-3l0,-30.5c-0,-0.351 -0.06,-0.687 -0.171,-1l2.171,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-30,43.5l-4.083,0c-0.477,2.836 -2.946,5 -5.917,5c-2.971,-0 -5.44,-2.164 -5.917,-5l-4.083,0c-1.326,-0 -2.598,0.527 -3.536,1.464c-0.937,0.938 -1.464,2.21 -1.464,3.536c0,0 0,7 0,7l4,-0l0,-4c0,-0.552 0.448,-1 1,-1c0.552,0 1,0.448 1,1l0,4l18,-0l0,-4c0,-0.552 0.448,-1 1,-1c0.552,0 1,0.448 1,1l0,4l4,-0l0,-7c0,-1.326 -0.527,-2.598 -1.464,-3.536c-0.938,-0.937 -2.21,-1.464 -3.536,-1.464Zm-6.126,0l-7.748,0c0.445,1.724 2.012,3 3.874,3c1.862,-0 3.429,-1.276 3.874,-3Zm6.126,-2l-20,-0c0,0 0,-17.25 0,-17.25c0,-4.971 4.029,-9 9,-9c0.665,0 1.335,0 2,0c4.971,0 9,4.029 9,9l0,17.25Zm-2,-17c-0,-0.552 -0.448,-1 -1,-1l-6.382,0c0,-0 -1.724,-3.447 -1.724,-3.447c-0.169,-0.339 -0.515,-0.553 -0.894,-0.553c-0.379,-0 -0.725,0.214 -0.894,0.553l-1.724,3.447c-0,0 -2.382,0 -2.382,0c-0.552,0 -1,0.448 -1,1l0,10c0,2.761 2.239,5 5,5c1.881,0 4.119,0 6,0c2.761,-0 5,-2.239 5,-5c-0,-4.138 -0,-10 -0,-10Zm-2,1l-0,9c-0,1.657 -1.343,3 -3,3c-0,-0 -6,0 -6,0c-1.657,-0 -3,-1.343 -3,-3c0,-0 0,-9 0,-9c-0,0 2,0 2,0c0.379,-0 0.725,-0.214 0.894,-0.553l1.106,-2.211c0,0 1.106,2.211 1.106,2.211c0.169,0.339 0.515,0.553 0.894,0.553l6,-0Zm14.5,6l11.5,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-11.5,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm-3.5,-5l15,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-15,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-5l15,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-15,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm0,-5l15,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-15,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-7,-5l22,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-22,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">{{ $lecturer }}</h4>
                                        <div class="text-gray-500">Dosen</div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
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
                                        <h4 class="text-2xl font-semibold text-gray-700">{{ $student }}</h4>
                                        <div class="text-gray-500">Mahasiswa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-8 px-6">
                        <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4">
                        <label for="periode" class="block mb-1 font-semibold">Pilih Periode:</label>
                        <select name="periode" id="periode" onchange="this.form.submit()" class="border rounded px-3 py-2">
                            <option value="">Semua</option>
                            @foreach($availablePeriods as $period)
                                <option value="{{ $period }}" {{ request('periode') == $period ? 'selected' : '' }}>
                                    {{ $period }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    </div>
                    

                    <div class="w-full mt-8 px-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Grafik Kehadiran Mahasiswa</h2>
                        <canvas id="attendanceChart" height="100"></canvas>
                    </div>
                </div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('attendanceChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: {!! json_encode($data) !!},
                backgroundColor: ['#34d399', '#facc15', '#60a5fa', '#c084fc', '#f87171']
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>

                @endrole
               
            </div>







        </div>
    @endsection
</x-app-layout>
