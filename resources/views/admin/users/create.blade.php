<x-app-layout>
    @section('name_page', 'Users')

    @section('content')
    <div class="mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Tambah Users</h2>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="name" name="name" 
                               class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" 
                               placeholder="Masukan Username">
                    </div>

                    <div>
                        <label for="avatar" class="block mb-2 text-sm font-medium text-gray-700">Upload Profile</label>
                        <input type="file" id="avatar" name="avatar" 
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" 
                               class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" 
                               placeholder="Masukan Email">
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" 
                               class="bg-yellow-50 border border-yellow-500 text-yellow-900 placeholder-yellow-700 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" 
                               placeholder="Masukan password">
                    </div>

                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="role" 
                                class="bg-yellow-50 border border-yellow-500 text-yellow-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" 
                            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>