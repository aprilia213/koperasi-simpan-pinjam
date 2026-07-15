<x-app-layout>
<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="bg-white rounded-3xl shadow-xl border border-emerald-100 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-700 to-green-700 p-8 text-white">
                <h1 class="text-2xl font-extrabold">
                    Tambah Simpanan
                </h1>

                <p class="mt-2 text-emerald-100">
                    Isi form untuk melakukan penyetoran simpanan.
                </p>
            </div>

            <!-- Informasi Rekening -->
            <div class="mx-8 mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xl">
                        💳
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-emerald-700">
                            Transfer ke Rekening Berikut
                        </h2>

                        <p class="text-sm text-slate-600">
                            Silakan transfer sesuai nominal simpanan, kemudian unggah bukti pembayaran pada form di bawah.
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <!-- BCA -->
                    <div class="bg-white rounded-xl border border-emerald-100 p-5 shadow-sm">
                        <p class="text-sm text-slate-500">
                            Bank BCA
                        </p>

                        <h3 class="mt-2 text-xl font-bold text-slate-800">
                            1234567890
                        </h3>

                        <p class="mt-2 text-sm text-emerald-700 font-semibold">
                            a.n. KOPERASI SEJAHTERA MANDIRI
                        </p>
                    </div>

                    <!-- BNI -->
                    <div class="bg-white rounded-xl border border-emerald-100 p-5 shadow-sm">
                        <p class="text-sm text-slate-500">
                            Bank BNI
                        </p>

                        <h3 class="mt-2 text-xl font-bold text-slate-800">
                            0987654321
                        </h3>

                        <p class="mt-2 text-sm text-emerald-700 font-semibold">
                            a.n. KOPERASI SEJAHTERA MANDIRI
                        </p>
                    </div>

                    <!-- BRI -->
                    <div class="bg-white rounded-xl border border-emerald-100 p-5 shadow-sm">
                        <p class="text-sm text-slate-500">
                            Bank BRI
                        </p>

                        <h3 class="mt-2 text-xl font-bold text-slate-800">
                            1122334455
                        </h3>

                        <p class="mt-2 text-sm text-emerald-700 font-semibold">
                            a.n. KOPERASI SEJAHTERA MANDIRI
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('simpanan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                
            @if(session('error'))
            <div class="mb-5 p-4 rounded-xl bg-red-100 border border-red-300 text-red-700">
                {{ session('error') }}
            </div>
            @endif

            @csrf
            <!-- Jenis Simpanan -->
            <div class="mb-6">
                <label class="block font-semibold text-slate-700 mb-2">
                    Jenis Simpanan
                </label>
                
                <select name="jenis" class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">
                        Pilih jenis simpanan
                    </option>

                    @if(!$sudahBayarPokok)
                    <option value="pokok">
                        Simpanan Pokok
                    </option>
                    @endif

                    <option value="wajib">
                        Simpanan Wajib
                    </option>

                    <option value="sukarela">
                        Simpanan Sukarela
                    </option>
                </select>

                @error('jenis')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Jumlah -->
            <div class="mb-6">
                <label class="block font-semibold text-slate-700 mb-2">
                    Jumlah Simpanan
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-3 text-slate-500">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="jumlah"
                        placeholder="Masukkan jumlah uang"
                        class="w-full pl-12 rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                </div>
                @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold text-slate-700 mb-2">
                    Bukti Pembayaran
                </label>

                <input type="file" name="bukti_pembayaran" class="w-full rounded-xl border-slate-300">
                <p class="text-sm text-slate-500 mt-2">
                    Upload bukti transfer (jpg, jpeg, png).
                </p>
            </div>

            <!-- Button -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('simpanan') }}" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 transition">
                    Kembali
                </a>

                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg">
                    Simpan
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
</x-app-layout>