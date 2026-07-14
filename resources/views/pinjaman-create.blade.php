<x-app-layout>
<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="bg-white rounded-3xl shadow-xl border border-emerald-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-700 to-green-700 p-8 text-white">
                <h1 class="text-2xl font-extrabold">
                    Ajukan Pinjaman
                </h1>

                <p class="mt-2 text-emerald-100">
                    Isi formulir berikut untuk mengajukan pinjaman koperasi.
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('pinjaman.store') }}" method="POST" class="p-8">
                @csrf

                @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-100 border border-green-300 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 rounded-xl bg-yellow-100 border border-yellow-300 p-4 text-yellow-700">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Jumlah Pinjaman -->
                <div class="mb-6">
                    <label class="block font-semibold text-slate-700 mb-2">
                        Jumlah Pinjaman
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-3 text-slate-500">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="jumlah_pinjaman"
                            value="{{ old('jumlah_pinjaman') }}"
                            placeholder="Masukkan jumlah pinjaman"
                            class="w-full pl-12 rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    @error('jumlah_pinjaman')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Lama Angsuran -->
                <div class="mb-6">
                    <label class="block font-semibold text-slate-700 mb-2">
                        Lama Angsuran
                    </label>

                    <select name="lama_angsuran" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">
                            Pilih Lama Angsuran
                        </option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                        <option value="24">24 Bulan</option>
                        <option value="36">36 Bulan</option>
                    </select>
                    @error('lama_angsuran')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Simulasi Pinjaman -->
                <div class="mb-8">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">
                        <h3 class="text-lg font-bold text-emerald-700 mb-5">
                            Simulasi Pinjaman
                        </h3>

                        <div class="grid md:grid-cols-2 gap-5">
                            <div class="bg-white rounded-xl p-4 shadow">
                                <p class="text-sm text-slate-500">
                                    Bunga
                                </p>

                                <h4 id="bunga" class="text-2xl font-bold text-emerald-600">
                                    0 %
                                </h4>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow">
                                <p class="text-sm text-slate-500">
                                    Total Pinjaman
                                </p>

                                <h4 id="total" class="text-2xl font-bold text-emerald-600">
                                    Rp 0
                                </h4>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow md:col-span-2">
                                <p class="text-sm text-slate-500">
                                    Estimasi Angsuran per Bulan
                                </p>

                                <h4 id="angsuran" class="text-3xl font-bold text-emerald-700">
                                    Rp 0
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi -->
                <div class="mb-8 rounded-2xl bg-emerald-50 border border-emerald-100 p-5">
                    <h3 class="font-semibold text-emerald-700 mb-2">
                        Informasi Pengajuan
                    </h3>

                    <ul class="text-sm text-slate-600 space-y-2 list-disc ml-5">
                        <li>
                            Pastikan Anda sudah menjadi anggota aktif koperasi.
                        </li>

                        <li>
                            Pengajuan akan diproses oleh admin koperasi.
                        </li>

                        <li>
                            Status awal pengajuan adalah <strong>Menunggu</strong>.
                        </li>

                        <li>
                            Setelah disetujui, pinjaman dapat dicairkan sesuai ketentuan koperasi.
                        </li>
                    </ul>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-4">
                    @if($anggotaAktif)
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg">
                            Ajukan Pinjaman
                        </button>
                    @else
                        <div class="w-full rounded-2xl bg-yellow-50 border border-yellow-200 p-5 text-yellow-700">
                            <h3 class="font-semibold text-yellow-700 mb-2">
                                Status Anggota
                            </h3>

                            <p class="text-sm">
                                Belum Aktif
                            </p>

                            <p class="text-sm mt-1">
                                Silahkan tunggu konfirmasi Simpanan Pokok dan Simpanan Wajib dari admin.
                            </p>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>