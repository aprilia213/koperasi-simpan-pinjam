<x-guest-layout>
    <div class="mb-8">
        <!-- Security Shield Icon -->
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4 border border-emerald-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Verifikasi Keamanan (2FA)</h2>
        <p class="text-sm text-slate-500 mt-1">Masukkan kode OTP dari aplikasi authenticator Anda demi keamanan transaksi koperasi.</p>
    </div>

    <form method="POST" action="{{ route('two-factor.login.store') }}">
        @csrf

        <!-- Authentication Code -->
        <div>
            <x-input-label for="code" :value="__('Kode Autentikasi (OTP)')" />
            <x-text-input
                id="code"
                class="block mt-1 w-full text-center text-lg tracking-widest font-bold focus:border-emerald-500 focus:ring-emerald-500"
                type="text"
                name="code"
                placeholder="000000"
                autofocus
                autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <!-- Divider / Recovery option header -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-slate-100"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-2 text-slate-400">Atau gunakan Kode Pemulihan</span>
            </div>
        </div>

        <!-- Recovery Code -->
        <div>
            <x-input-label for="recovery_code" :value="__('Kode Pemulihan (Recovery Code)')" />
            <x-text-input
                id="recovery_code"
                class="block mt-1 w-full text-center font-mono focus:border-emerald-500 focus:ring-emerald-500"
                type="text"
                name="recovery_code"
                placeholder="xxxx-xxxx-xxxx"
                autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Verifikasi & Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center text-xs text-slate-400">
        Kehilangan akses authenticator? Hubungi CS Koperasi.
    </div>
</x-guest-layout>