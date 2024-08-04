<x-app-layout>
    @section('name_page', 'Users')

    @section('content')
        <div class="mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Melengkapi Identitas Mahasiswa</h2>

                <form action="{{ route('student.students.store', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" id="nim" name="nim"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="Masukan NIM">
                        </div>

                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="name" name="name"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="Masukan Nama">
                        </div>
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Alamat</label>
                            <textarea type="text" id="address" name="address"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="Masukan Alamat"></textarea>
                        </div>
                        <div>
                            <label for="number_phone" class="block mb-2 text-sm font-medium text-gray-700">NO Telp</label>
                            <input type="text" id="number_phone" name="number_phone"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="Masukan number_phone">
                        </div>
                        <div>
                            <label for="signature" class="block mb-2 text-sm font-medium text-gray-700">Upload
                                Tanda Tangan</label>
                            <input type="file" id="signature" name="signature"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <div>
                            <label for="student_class_id" class="block mb-2 text-sm font-medium text-gray-700">Kelas</label>
                            <select id="student_class_id" name="student_class_id"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                                <option value="" disabled>Pilih Kelas</option>
                                @foreach ($student_class as $sclass)
                                    <option value="{{ $sclass->id }}">{{ $sclass->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            
                            <input type="text" id="user_id" name="user_id" value="{{ $user->id }}"
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 w-full p-2.5 hidden">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>
