<section>
    @section('main_folder', '/ Biodata Diri')
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Biodata Diri') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Edit Informasi Biodata Diri") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <div>
                    <x-input-label for="name" :value="__('Username')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                @if($user->hasRole('dosen'))
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->lecturer->name)" readonly autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="nip" :value="__('NIP')" />
                        <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip', $user->lecturer->nip)" readonly autofocus autocomplete="nip" />
                        <x-input-error class="mt-2" :messages="$errors->get('nip')" />
                    </div>
                @endif

                @if($user->hasRole('mahasiswa'))
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->student->name)" readonly autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="nim" :value="__('NIM')" />
                        <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" :value="old('nim', $user->student->nim)" readonly autofocus autocomplete="nim" />
                        <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                    </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <x-input-label for="avatar" :value="__('Foto Profil')" />
                    <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar ?? '')" accept=".jpg,.jpeg,.png" autofocus autocomplete="avatar" />
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                    <div class="mt-2">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" class="w-32 h-32 object-cover rounded-2xl border border-gray-200" alt="avatar" />
                        @else
                            <p class="text-gray-500 text-sm">Foto profil belum diunggah.</p>
                        @endif
                    </div>
                </div>

                @if ($user->hasRole('dosen|mahasiswa'))
                    <div>
                    <x-input-label for="signature" :value="__('Tanda Tangan')" />
                    <x-text-input id="signature" name="signature" type="file" class="mt-1 block w-full" :value="old('signature', $user->hasRole('dosen') ? $user->lecturer->signature ?? '' : $user->student->signature ?? '')" accept=".jpg,.jpeg,.png" autofocus autocomplete="signature" />
                    <x-input-error class="mt-2" :messages="$errors->get('signature')" />
                        <div class="mt-2">
                            @if ($user->hasRole('dosen') && $user->lecturer->signature)
                                <img src="{{ Storage::url($user->lecturer->signature) }}" class="w-32 h-24 object-contain border border-gray-200 rounded-2xl" alt="Signature" />
                            @elseif ($user->hasRole('mahasiswa') && $user->student->signature)
                                <img src="{{ Storage::url($user->student->signature) }}" class="w-32 h-24 object-contain border border-gray-200 rounded-2xl" alt="Signature" />
                            @else
                                <p class="text-gray-500 text-sm">Tanda tangan belum diunggah.</p>
                            @endif
                        </div>
                    </div>
                @endif

                
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Biodata Diri Berhasil Diperbarui.') }}</p>
            @endif
        </div>
    </form>
</section>