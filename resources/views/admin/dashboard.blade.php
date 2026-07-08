<x-app-layout>

    <!-- Hero Section -->
    <section class="relative bg-white overflow-hidden py-16 sm:py-20 lg:py-24">
        <!-- Decorative Background Graphic -->
        <div class="absolute top-0 right-0 -mr-40 w-[600px] h-[600px] bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-12 gap-10 items-center">
                
                <!-- Hero Content -->
                <div class="sm:text-center lg:text-left lg:col-span-7">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Dashboard Administrator
                    </span>

                    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        Selamat Datang, <br>
                        <span class="text-emerald-600">{{ Auth::user()->name }}</span>
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed">
                        Kelola seluruh data koperasi mulai dari anggota, simpanan, pinjaman, transaksi hingga laporan keuangan secara mudah, transparan, dan terintegrasi dalam satu dasbor sistem.
                    </p>
                </div>

                <!-- Admin Information Card -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span>Informasi Administrator</span>
                        </h2>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-sm font-medium text-slate-500">Nama</span>
                                <span class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-sm font-medium text-slate-500">Email</span>
                                <span class="text-sm font-semibold text-slate-800">{{ Auth::user()->email }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-slate-500">Role Akses</span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 uppercase tracking-wider">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>

                            <div class="mt-5 rounded-2xl bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 text-sm flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> Sesi masuk administrator aktif dan aman.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Statistik Section (Dinamisasi dengan PHP/Blade) -->
    <section class="py-16 bg-slate-50 border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Stat 1: Total Anggota -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        👥
                    </div>
                    <h3 class="font-bold text-slate-500 text-sm uppercase tracking-wider">Total Anggota</h3>
                    <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ $totalAnggota ?? '0' }} <span class="text-xs font-normal text-slate-400">Orang</span></p>
                    <p class="text-xs text-slate-400 mt-1">Basis data anggota terdaftar.</p>
                </div>

                <!-- Stat 2: Total Simpanan -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        💰
                    </div>
                    <h3 class="font-bold text-slate-500 text-sm uppercase tracking-wider">Total Simpanan</h3>
                    <p class="text-2xl font-extrabold text-slate-900 mt-2">Rp {{ number_format($totalSimpanan ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 mt-1">Akumulasi pokok, wajib & sukarela.</p>
                </div>

                <!-- Stat 3: Total Pinjaman -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        📄
                    </div>
                    <h3 class="font-bold text-slate-500 text-sm uppercase tracking-wider">Dana Dipinjamkan</h3>
                    <p class="text-2xl font-extrabold text-slate-900 mt-2">Rp {{ number_format($totalPinjaman ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 mt-1">Plafon kredit aktif yang beredar.</p>
                </div>

                <!-- Stat 4: Kas / Laporan -->
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        📊
                    </div>
                    <h3 class="font-bold text-slate-500 text-sm uppercase tracking-wider">Estimasi SHU</h3>
                    <p class="text-2xl font-extrabold text-emerald-600 mt-2">Rp {{ number_format($estimasiShu ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 mt-1">Akumulasi pendapatan berjalan.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Kantor & Kontak Section -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Kolom Kiri: Detail Alamat, Kontak & Sosmed (5 Kolom) -->
                <div class="lg:col-span-5 flex flex-col justify-between space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8 h-full flex flex-col justify-between">
                        
                        <div>
                            <span class="text-emerald-600 font-bold uppercase tracking-wider text-xs">Identitas Koperasi</span>
                            <h2 class="text-2xl font-extrabold text-slate-900 mt-1 mb-6">Kantor & Layanan</h2>
                            
                            <!-- Alamat -->
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-10 h-10 shrink-0 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold">📍</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Alamat Pusat</h4>
                                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">Bau-bau, Kec. Murhum, Kota Bau-Bau, Sulawesi Tenggara</p>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-10 h-10 shrink-0 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold">📞</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Saluran Komunikasi</h4>
                                    <p class="text-sm text-slate-500 mt-0.5">Telepon: (021) 555-0199</p>
                                    <p class="text-sm text-slate-500">WhatsApp: +62 812-3456-7890</p>
                                </div>
                            </div>

                            <!-- Jam Operasional Admin -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 shrink-0 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold">🕒</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Jam Kerja Sistem</h4>
                                    <p class="text-sm text-slate-500 mt-0.5">Senin - Jumat: 08:00 - 16:00 WIB</p>
                                    <p class="text-sm text-slate-500">Sabtu: 08:00 - 12:00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Media Sosial Jejaring -->
                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Media Sosial Resmi</h4>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ env('KOPERASI_WEBSITE', '#') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 text-xs font-semibold text-slate-600 hover:text-emerald-700 transition-all duration-200">
                                    🌐 <span>Website</span>
                                </a>
                                <a href="{{ env('KOPERASI_INSTAGRAM', 'https://instagram.com') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 text-xs font-semibold text-slate-600 hover:text-emerald-700 transition-all duration-200">
                                    📸 <span>Instagram</span>
                                </a>
                                <a href="{{ env('KOPERASI_FACEBOOK', 'https://facebook.com') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 text-xs font-semibold text-slate-600 hover:text-emerald-700 transition-all duration-200">
                                    📘 <span>Facebook</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>   
                <!-- Kolom Kanan Google Maps -->
            <div class="lg:col-span-7">

                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-3 h-full">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127092.5622373029!2d122.52398468347998!3d-5.471069775967565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2da474035c058aa1%3A0x92cb0c1ab34ae84a!2sBau-bau%2C%20Kec.%20Murhum%2C%20Kota%20Bau-Bau%2C%20Sulawesi%20Tenggara!5e0!3m2!1sid!2sid!4v1783503217782!5m2!1sid!2sid"
                        width="100%"
                        height="430"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                </div>

            </div>             
    </section>

</x-app-layout>