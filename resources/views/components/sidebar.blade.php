<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('image/JKB.png') }}" class="w-12 h-12" viewBox="0 0 512 512" fill="none" fill="white">
            </path>
            </img>

            <span class="mx-2 text-2xl font-semibold text-white">SI Perkuliahan</span>
        </div>
        <button @click="sidebarOpen = false" class="text-gray-600 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="mt-10">
        <a class="flex items-center px-6 py-2 mt-4 {{ setActive('dashboard.index') }}"
            href="{{ route('dashboard.index') }}">
            <i class="fa-solid fa-house"></i>
            <span class="mx-3">Dashboard</span>
        </a>

        @role('super_admin')
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.lecturer_documents.*') }}"
                href="{{ route('masterdata.lecturer_documents.index') }}">
                <i class="fa-solid fa-file"></i>
                <span class="mx-3">Dokumen Perkuliahan</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.users.*') }} {{ setActive('profile') }}"
                href="{{ route('masterdata.users.index') }}">
                <i class="fa-solid fa-user"></i>
                <span class="mx-3">Pengguna</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.periode.*') }}"
                href="{{ route('masterdata.periode.index') }}">
                {{-- <i class="fa-solid fa-clock"></i> --}}
                <i class="fa-solid fa-hourglass-end"></i>
                <span class="mx-3">Periode</span>
            </a>


            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.study_programs.*') }}"
                href="{{ route('masterdata.study_programs.index') }}">
                <i class="fa-solid fa-school"></i>
                <span class="mx-3">Program Studi</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.student_classes.*') }} {{ setActive('masterdata.assign.course.class') }} "
                href="{{ route('masterdata.student_classes.index') }}">
                <i class="fa-solid fa-landmark"></i>
                <span class="mx-3">Kelas</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.positions.*') }}"
                href="{{ route('masterdata.positions.index') }}">
                <i class="fa-solid fa-user-plus"></i>
                <span class="mx-3">Jabatan</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.courses.*') }}"
                href="{{ route('masterdata.courses.index') }}">
                <i class="fa-solid fa-brain"></i>
                <span class="mx-3">Mata Kuliah</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('masterdata.students.*') }}"
                href="{{ route('masterdata.students.index') }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="mx-3">Mahasiswa</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4   
            {{ setActive('masterdata.lecturers.*') }}   
            {{ setActive('masterdata.assign.lecturer.position') }}   
            {{ setActive('masterdata.assign.course.lecturer') }}"
                href="{{ route('masterdata.lecturers.index') }}">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span class="mx-3">Dosen</span>
            </a>
        @endrole

        @role('dosen')
            @if ($nidn)
                <a class="flex items-center px-6 py-2 mt-4 {{ setActive('lecturer.dokumen_perkuliahan*') }} {{ setActive('lecturer.lecturer_document*') }} "
                    href="{{ route('lecturer.dokumen_perkuliahan', ['nidn' => $nidn]) }}">
                    <i class="fa-solid fa-file"></i>
                    <span class="mx-3">Dokumen Perkuliahan</span>
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
                @endif
                <a class="flex items-center px-6 py-2 mt-4 {{ setActive('lecturer.daftar_dokumen_perkuliahan*') }}"
                    href="{{ route('lecturer.daftar_dokumen_perkuliahan', ['nidn' => $nidn]) }}">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="mx-3">Daftar Dokumen Perkuliahan</span>
                </a>
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

            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('student.dokumen_perkuliahan*') }} {{ setActive('student.lecturer_document*') }} "
                href="{{ route('student.dokumen_perkuliahan', $user->student->id) }}">
                <i class="fa-solid fa-file"></i>
                <span class="mx-3">Dokumen Perkuliahan</span>
            </a>
            <a class="flex items-center px-6 py-2 mt-4 {{ setActive('student.dokumen_perkuliahan*') }} {{ setActive('student.lecturer_document*') }} "
                href="#">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="mx-3">Absensi Mahasiswa</span>
            </a>
        @endrole
    </nav>
</div>
