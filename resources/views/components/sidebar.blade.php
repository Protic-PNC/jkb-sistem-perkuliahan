<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('image/JKB.png') }}" class="w-12 h-12" viewBox="0 0 512 512" fill="none" fill="white">
            </path>
            </img>

            <span class="mx-2 text-2xl font-semibold text-white">ATTENDIX</span>
        </div>
        <button @click="sidebarOpen = false" class="text-gray-600 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="mt-10">
        
        <a class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white{{ setActive('dashboard.index') }}"
            href="{{ route('dashboard.index') }}">
            <i class="fa-solid fa-house"></i>
            <span class="mx-3">Dashboard</span>
        </a>
       

        @role('super_admin')
        <li>
            <button type="button"
                class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white"
                aria-controls="dropdown-pages"
                data-collapse-toggle="dropdown-pages">
                
                {{-- Icon folder --}}
                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"></path>
                </svg>

                {{-- Label --}}
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Dokumen Perkuliahan</span>

                {{-- Icon dropdown --}}
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <ul id="dropdown-pages"
                
                class="py-2 space-y-2 {{ request()->routeIs(
                    'dokumen_perkuliahan.kelola.*',
                    'dokumen_perkuliahan.daftar.*',
                ) ? '' : 'hidden' }}">
                
                <li>
                    <a href="{{ route('dokumen_perkuliahan.kelola.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('dokumen_perkuliahan.kelola.*') }}">
                        <i class="fa fa-circle mr-2"></i> Kelola
                    </a>
                </li>
                <li>
                    <a href="{{ route('dokumen_perkuliahan.daftar.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ 
                            setActive([
                                'dokumen_perkuliahan.daftar.*',
                            ]) 
                        }}">
                        <i class="fa fa-circle mr-2"></i> Daftar
                    </a>
                </li>
            </ul>
        </li>

            
           
            <li>
            <button type="button"
                class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white"
                aria-controls="dropdown-masterdata"
                data-collapse-toggle="dropdown-masterdata">
                
                {{-- Icon Master Data --}}
                <i class="fa-solid fa-database w-6 h-6 text-gray-400 group-hover:text-white"></i>

                <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Data</span>

                {{-- Dropdown arrow --}}
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <ul id="dropdown-masterdata"
                class="py-2 space-y-2 {{ request()->routeIs(
                    'masterdata.users.*',
                    'profile',
                    'masterdata.periode.*',
                    'masterdata.study_programs.*',
                    'masterdata.student_classes.*',
                    'masterdata.assign.course.class',
                    'masterdata.positions.*',
                    'masterdata.courses.*',
                    'masterdata.students.*',
                    'masterdata.lecturers.*',
                    'masterdata.jadwal.*',
                    'masterdata.assign.lecturer.position',
                    'masterdata.assign.course.lecturer'
                ) ? '' : 'hidden' }}">
                
                <li>
                    <a href="{{ route('masterdata.users.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.users.*') }} {{ setActive('profile') }}">
                        <i class="fa-solid fa-user mr-2"></i> Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.jadwal.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.jadwal.*') }}">
                        <i class="fa-solid fa-list mr-2"></i> Jadwal
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.periode.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.periode.*') }}">
                        <i class="fa-solid fa-hourglass-end mr-2"></i> Periode
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.study_programs.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.study_programs.*') }}">
                        <i class="fa-solid fa-school mr-2"></i> Program Studi
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.student_classes.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.student_classes.*') }} {{ setActive('masterdata.assign.course.class') }}">
                        <i class="fa-solid fa-landmark mr-2"></i> Kelas
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.positions.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.positions.*') }}">
                        <i class="fa-solid fa-user-plus mr-2"></i> Jabatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.courses.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.courses.*') }}">
                        <i class="fa-solid fa-brain mr-2"></i> Mata Kuliah
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.students.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('masterdata.students.*') }}">
                        <i class="fa-solid fa-graduation-cap mr-2"></i> Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('masterdata.lecturers.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium 
                        {{ setActive('masterdata.lecturers.*') }}
                        {{ setActive('masterdata.assign.lecturer.position') }}
                        {{ setActive('masterdata.assign.course.lecturer') }}">
                        <i class="fa-solid fa-chalkboard-user mr-2"></i> Dosen
                    </a>
                </li>
            </ul>
        </li>

        @endrole

        @role('dosen')
            @if ($nidn)
                {{-- <a class="flex items-center px-6 py-2 mt-4 {{ setActive('lecturer.dokumen_perkuliahan*') }} {{ setActive('lecturer.lecturer_document*') }} "
                    href="{{ route('lecturer.dokumen_perkuliahan', ['nidn' => $nidn]) }}">
                    <i class="fa-solid fa-file"></i>
                    <span class="mx-3">Kelola</span>
                </a>
                
                @if ($user->lecturer->position->name == 'Koordinator Program Studi')
                    <a class="flex items-center px-6 py-2 mt-4 {{ setActive('lecturer.daftar_persetujuan_dokumen*') }}"
                        href="{{ route('lecturer.daftar_persetujuan_dokumen', ['id' => $user->lecturer->position_id]) }}">
                        
                        <i class="fa-solid fa-folder"></i>
                        <span class="mx-3">Daftar Persetujuan Kaprodi</span>
                    </a>
                @elseif ($user->lecturer->position->name == 'Kepala Jurusan')
                <a class="flex items-center px-6 py-2 mt-4 {{ setActive('lecturer.daftar_persetujuan_dokumen*') }}"
                href="{{ route('lecturer.daftar_persetujuan_dokumen', ['id' => $user->lecturer->position_id]) }}">
                
                    <i class="fa-solid fa-folder"></i>
                    <span class="mx-3">Daftar Persetujuan Kepala Jurusan</span>
                </a>
                @endif --}}
                <li>
            <button type="button"
                class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white"
                aria-controls="dropdown-pages"
                data-collapse-toggle="dropdown-pages">
                
                {{-- Icon folder --}}
                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"></path>
                </svg>

                {{-- Label --}}
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Dokumen Perkuliahan</span>

                {{-- Icon dropdown --}}
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <ul id="dropdown-pages"
                
                class="py-2 space-y-2 {{ request()->routeIs(
                    'd.dokumen_perkuliahan*',
                    'd.daftar_persetujuan_dokumen*'
                ) ? '' : 'hidden' }}">
                
                <li>
                    <a href="{{ route('d.dokumen_perkuliahan', ['nidn' => $nidn]) }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('d.dokumen_perkuliahan*') }}">
                        <i class="fa fa-circle mr-2"></i> Kelola
                    </a>
                </li>
                
                @if ($user->lecturer->position->name == 'Koordinator Program Studi')
                <li>
                    <a  href="{{ route('d.daftar_persetujuan_dokumen', ['id' => $user->lecturer->position_id]) }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('d.daftar_persetujuan_dokumen*') }}">
                        <i class="fa fa-circle mr-2"></i> Daftar Persetujuan Kaprodi
                    </a>
                </li>
                    
                @elseif ($user->lecturer->position->name == 'Kepala Jurusan')
                <li>
                    <a  href="{{ route('d.daftar_persetujuan_dokumen', ['id' => $user->lecturer->position_id]) }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-medium {{ setActive('d.daftar_persetujuan_dokumen*') }}">
                        <i class="fa fa-circle mr-2"></i> Daftar Persetujuan Kepala Jurusan
                    </a>
                </li>
                
                @endif 
            </ul>
        </li>
                
            @else
                <div class="flex items-center px-6 py-2 mt-4 m-4 text-red-500 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="mx-3">Data Dosen Tidak Lengkap. Silakan Hubungi Admin.</span>
                </div>
            @endif
        @endrole
        @role('mahasiswa')
            @php
                $user = Auth::user();
            @endphp

            {{-- <a class="flex items-center px-6 py-2 mt-4 {{ setActive('student.dokumen_perkuliahan*') }} {{ setActive('student.lecturer_document*') }} "
                href="{{ route('student.dokumen_perkuliahan', $user->student->id) }}">
                <i class="fa-solid fa-file"></i>
                <span class="mx-3">Dokumen Perkuliahan</span>
            </a> --}}
            <a class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white{{ setActive('m.dokumen_perkuliahan*') }}"
            href="{{ route('m.dokumen_perkuliahan', $user->student->id) }}"><i class="fa-solid fa-file"></i>
            <span class="mx-3">Dokumen Perkuliahan</span>
            </a>
            <a class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 dark:text-white{{ setActive('m.riwayat_absensi*') }}"
            href="{{ route('m.riwayat_absensi', $user->student->nim) }}"><i class="fa-solid fa-layer-group"></i>
            <span class="mx-3">Riwayat Absensi</span>
            </a>
            
        @endrole
    </nav>
</div>
