

<x-app-layout>
    @section('main_folder', '/ Master Data')
    @section('descendant_folder', '/ Dosen')

    @section('content')

        <section class="bg-white dark:bg-gray-900">
            <div class="py-4 px-2 mx-auto lg:m-8 sm:m-4">
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
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Dosen</h2>
                <form action="{{ route('masterdata.lecturers.update', $lecturer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $lecturer->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>
                        <div class="w-full">
                            <label for="nidn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIDN</label>
                            <input type="text" name="nidn" id="nidn" value="{{ $lecturer->nidn }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>

                        <div class="w-full">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">address</label>
                            <textarea type="text" name="address" id="address"  
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required=""> {{ $lecturer->address }}</textarea>
                        </div>
                        <div class="w-full">
                            <label for="number_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">number_phone</label>
                            <input type="text" name="number_phone" id="number_phone" value="{{ $lecturer->number_phone }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="w-full">
                            <label for="signature" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanda Tangan</label>
                            <input type="file" id="signature" name="signature" accept=".png,.jpg,.jpeg" 
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            <img src="{{ Storage::url($lecturer->signature) }}" alt="" class="object-cover w-[120px] h-90px rounded-2xl">
                        </div>
                        <div class="w-full">
                            <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ $lecturer->nip }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 required="">
                        </div>
                        
                        <div>
                            <label for="position_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                            <select id="position_id" name="position_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="{{ $lecturer->position?->id }}">{{ $lecturer->position?->name ? $lecturer->position?->name . $lecturer->prodis?->name : 'Pilih Jabatan'  }}</option>
                                
                                @foreach ($jabatan as $d)
                                    <option value="{{ $d->id }}"> {{ $d->name }} {{ $d->prodis?->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pilih Mata Kuliah:
                            </label>
                            
                            <div class="relative">
                                <button id="dropdownButton" type="button"
                                    class="w-full px-4 py-2 text-gray-900 bg-white border border-gray-300 rounded-lg text-left focus:ring-blue-500 focus:border-blue-500 flex justify-between items-center">
                                    <span id="selectedCourses">Pilih Mata Kuliah</span>
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            
                                <!-- Dropdown Content -->
                                <div id="dropdown" class="hidden absolute z-10 w-full mt-2 bg-white shadow-md rounded-lg">
                                    <input type="text" id="searchCourse" placeholder="Cari Mata Kuliah..."
                                        class="w-full px-3 py-2 text-sm border-b border-gray-300 focus:outline-none">
                                    
                                    <ul id="courseList" class="max-h-48 overflow-y-auto py-2 text-gray-900">
                                        @foreach ($course as $c)
                                            @php
                                                $checked = $lecturer->course->contains($c->id) ? 'checked' : ''; // Cek apakah mata kuliah sudah dipilih
                                            @endphp
                                            <li class="px-4 py-2 hover:bg-gray-100">
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="course_id[]" value="{{ $c->id }}" class="mr-2 course-checkbox" {{ $checked }}>
                                                    {{ $c->name }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Edit
                    </button>
                </form>
            </div>
        </section>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dropdownButton = document.getElementById("dropdownButton");
                const dropdown = document.getElementById("dropdown");
                const searchInput = document.getElementById("searchCourse");
                const checkboxes = document.querySelectorAll(".course-checkbox");
                const selectedCourses = document.getElementById("selectedCourses");
            
                // Toggle dropdown visibility
                dropdownButton.addEventListener("click", function () {
                    dropdown.classList.toggle("hidden");
                });
            
                // Close dropdown when clicking outside
                document.addEventListener("click", function (event) {
                    if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add("hidden");
                    }
                });
            
                // Search filter for courses
                searchInput.addEventListener("input", function () {
                    const filter = searchInput.value.toLowerCase();
                    document.querySelectorAll("#courseList li").forEach(function (item) {
                        const text = item.textContent.toLowerCase();
                        item.style.display = text.includes(filter) ? "" : "none";
                    });
                });
            
                // Update selected courses text
                function updateSelectedCourses() {
                    let selected = [];
                    checkboxes.forEach((checkbox) => {
                        if (checkbox.checked) {
                            selected.push(checkbox.parentElement.textContent.trim());
                        }
                    });
                    selectedCourses.textContent = selected.length ? selected.join(", ") : "Pilih Mata Kuliah";
                }
            
                // Jalankan fungsi saat halaman dimuat untuk menampilkan mata kuliah yang sudah dipilih
                updateSelectedCourses();
            
                // Event listener untuk checkbox
                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("change", updateSelectedCourses);
                });
            });
            </script>
            
    @endsection
</x-app-layout>
