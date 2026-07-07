<x-guest-layout>
    <div class="mb-8">
        <!-- Mail Icon -->
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4 border border-emerald-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Verifikasi Email Anda</h2>
        <p class="text-sm text-slate-500 mt-1">Terima kasih telah mendaftar! Silakan periksa kotak masuk email Anda dan klik tautan verifikasi untuk mengaktifkan keanggotaan KSP Anda.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-sm text-emerald-700">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full justify-center">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="text-sm text-slate-500 hover:text-slate-800 underline underline-offset-4 font-medium transition duration-150">
                {{ __('Keluar Sesi (Logout)') }}
            </button>
        </form>
    </div>
</x-guest-layout>
