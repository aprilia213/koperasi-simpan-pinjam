<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Gabung Anggota</h2>
        <p class="text-sm text-slate-500 mt-1">Daftar sekarang untuk mulai menabung & mengajukan pinjaman</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Daftar Keanggotaan') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-100 text-center text-sm text-slate-600">
        Sudah memiliki akun? 
        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">
            Masuk Sekarang
        </a>
    </div>
</x-guest-layout>
