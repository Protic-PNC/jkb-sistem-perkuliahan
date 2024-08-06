<x-app-layout>
    @section('name_page', 'Users')

    @section('content')
        {{-- <div class="mx-auto p-6">
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
                            <label for="avatar" class="block mb-2 text-sm font-medium text-gray-700">Upload
                                Profile</label>
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
        </div> --}}

        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Users</h2>
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Username" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan Email" required="">
                        </div>
                        <div>
                            <label for="avatar" class="block mb-2 text-sm font-medium text-gray-700">Upload
                                Profile</label>
                            <input type="file" id="avatar" name="avatar"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <div class="w-full">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="$password" required="">
                        </div>
                        <div>
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="role" name="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Pilih role</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                            </select>
                        </div>
                        
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Tambah User
                    </button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
