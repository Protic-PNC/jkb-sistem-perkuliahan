
<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Daftar Hadir Kuliah')

    @section('content')
        <style>
            #success-message {
                transition: opacity 0.5s ease-out;
            }

            .attendance-header {
                font-size: 0.6rem;
                text-align: center;
            }

            .attendance-cell {
                width: 40px;
                text-align: center;
                font-size: 0.7rem;
            }

            .signature-line {
                border-bottom: 1px solid black;
                height: 30px;
            }

            .legend {
                font-size: 0.8rem;
            }
        </style>

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Hadir Kuliah</h3>
                    <hr class="border-t-4 my-2 mb-6 rounded-sm bg-gray-300">
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-slate-800">
                    <table class="w-full border-collapse font-sans">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th colspan="4" class="p-3 text-center text-lg font-bold">DETAIL VERIFIKASI DAFTAR HADIR KULIAH</th>
                            </tr>
                            <tr class="bg-gray-100 text-gray-700">
                                <th colspan="4" class="p-2 text-center text-sm font-medium uppercase">JURUSAN TEKNIK INFORMATIKA - PROGRAM STUDI {{  $data->student_class->study_program->jenjang }} -
                                    {{ $data->student_class->study_program->name }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="p-2 w-1/5">Mata Kuliah</td>
                                <td class="p-2 w-2/5">: {{ $data->course->name }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                
                                <td class="p-2">Kelas</td>
                                <td class="p-2">: {{ $data->student_class->study_program->name }} {{ $data->student_class->level }} {{ $data->student_class->name }}</td>
                            </tr>
                           
                            <tr class="bg-gray-50">
                                <td class="p-2">Tanggal Perkuliahan</td>
                                <td class="p-2">: {{\Carbon\Carbon::parse($details->created_at)->translatedFormat('j F Y') }} </td>
                                
                            </tr>
                            <tr>
                                <td class="p-2">Telah Di Verifikasi Tanggal :</td>
                                @if ($jabatan == 'Koordinator Program Studi')
                                <td class="p-2">: {{\Carbon\Carbon::parse($details->journal_detail->date_acc_kaprodi)->translatedFormat('j F Y') }}</td>
                                @elseif ($jabatan == 'Kepala Jurusan')
                                <td class="p-2">: {{\Carbon\Carbon::parse($details->journal_detail->date_acc_kajur)->translatedFormat('j F Y') }}</td>
                                @endif
                                
                            </tr>
                            <tr>
                                <td class="p-2">Oleh : </td>
                                {{-- <td class="p-2">: {{$details->attendenceList->name }}</td> --}}
                                @if ($jabatan == 'Koordinator Program Studi')
                                <td class="p-2">: {{ Auth::user()->lecturer->name }}</td>
                                @elseif ($jabatan == 'Kepala Jurusan')
                                <td class="p-2">: {{ Auth::user()->lecturer->name }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    
                    
                    
                </div>
            </div>
           
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    


        @push('after-script')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        setTimeout(function() {
                            successMessage.style.opacity = '0';
                            setTimeout(function() {
                                successMessage.remove();
                            }, 500);
                        }, 3000);
                    }
                });
            </script>
        @endpush
    @endsection
</x-app-layout>
