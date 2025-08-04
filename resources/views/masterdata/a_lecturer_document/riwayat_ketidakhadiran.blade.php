<x-app-layout>
    @section('main_folder', '/ Laporan Akademik')
    @section('descendant_folder', '/ Mahasiswa Tidak Memenuhi Syarat UAS')

    @section('content')
        <section class="bg-white dark:bg-gray-900">
            <div class="py-6 px-4 mx-auto max-w-screen-xl lg:py-6 lg:px-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Mahasiswa Tidak Memenuhi Syarat UAS</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Mahasiswa yang memiliki total ketidakhadiran lebih dari 30 jam</p>
                    <hr class="border-t-4 my-4 rounded-sm bg-gray-300">
                </div>

                @if($students->count() > 0)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-900 text-white">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">NIM</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Program Studi</th>
                                    <th class="px-4 py-3">Total Jam Ketidakhadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $student->nim }}</td>
                                        <td class="px-4 py-2">{{ $student->name }}</td>
                                        <td class="px-4 py-2">
                                            {{ $student->student_class->study_program->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 text-red-600 font-semibold">
                                            {{ $student->total_ketidakhadiran_jam }} jam
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700" role="alert">
                        <p class="font-bold">Tidak ada data</p>
                        <p>Semua mahasiswa memenuhi syarat kehadiran untuk mengikuti UAS.</p>
                    </div>
                @endif
            </div>
        </section>
    @endsection
</x-app-layout>
