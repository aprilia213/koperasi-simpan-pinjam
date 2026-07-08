<x-app-layout>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-white py-12 sm:py-24">

        <!-- Background -->
        <div class="absolute top-0 right-0 -mr-40 w-[600px] h-[600px] bg-emerald-50 rounded-full blur-3xl opacity-70 -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-12 gap-10 items-center">

                <!-- ================= LEFT ================= -->
                <div class="lg:col-span-7">

                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-widest">

                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>

                        Dashboard Anggota
                    </span>

                    <h1 class="mt-6 text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight">

                        Selamat Datang,

                        <br>

                        <span class="text-emerald-600">

                            {{ Auth::user()->name }}

                        </span>

                    </h1>

                    <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-xl">

                        Selamat datang di Sistem Informasi Koperasi Simpan Pinjam.
                        Kelola simpanan, pinjaman, transaksi serta seluruh aktivitas
                        keuangan Anda secara cepat, aman dan transparan.

                    </p>

                    <div class="mt-10 flex flex-wrap gap-4">

                        <a href="#menu-utama"
                            class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg transition">

                            Mulai Transaksi

                        </a>

                        <a href="#informasi"
                            class="px-6 py-3 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold transition">

                            Tentang Koperasi

                        </a>

                    </div>

                </div>

                <!-- ================= RIGHT ================= -->

                <div class="lg:col-span-5">

                    <div class="grid grid-cols-2 gap-8">

                        <!-- Total Simpanan -->
                        <div
                            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 to-green-950 p-6 text-white shadow-2xl">

                            <div
                                class="absolute -right-10 -top-10 w-28 h-28 rounded-full bg-white/10">
                            </div>

                            <div class="flex justify-between items-start">

                                <div>

                                    <p class="text-sm text-emerald-200">
                                        Total Simpanan
                                    </p>

                                    <h2 class="text-2xl font-bold mt-2">
                                        Rp 0
                                    </h2>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">

                                    💰

                                </div>

                            </div>

                        </div>

                        <!-- Total Pinjaman -->
                        <div
                            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 to-green-950 p-6 text-white shadow-2xl">

                            <div
                                class="absolute -right-10 -top-10 w-28 h-28 rounded-full bg-white/10">
                            </div>

                            <div class="flex justify-between items-start">

                                <div>

                                    <p class="text-sm text-emerald-200">
                                        Total Pinjaman
                                    </p>

                                    <h2 class="text-2xl font-bold mt-2">
                                        Rp 0
                                    </h2>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">

                                    💳

                                </div>

                            </div>

                        </div>

                        <!-- Total Transaksi -->
                        <div
                            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 to-green-950 p-6 text-white shadow-2xl">

                            <div
                                class="absolute -right-10 -top-10 w-28 h-28 rounded-full bg-white/10">
                            </div>

                            <div class="flex justify-between items-start">

                                <div>

                                    <p class="text-sm text-emerald-200">
                                        Total Transaksi
                                    </p>

                                    <h2 class="text-2xl font-bold mt-2">
                                        0
                                    </h2>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">

                                    📄

                                </div>

                            </div>

                        </div>

                        <!-- Status -->
                        <div
                            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 to-green-950 p-6 text-white shadow-2xl">

                            <div
                                class="absolute -right-10 -top-10 w-28 h-28 rounded-full bg-white/10">
                            </div>

                            <div class="flex justify-between items-start">

                                <div>

                                    <p class="text-sm text-emerald-200">
                                        Status Keanggotaan
                                    </p>

                                    <h2 class="text-xl font-bold mt-2">

                                        Aktif

                                    </h2>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">

                                    ✅

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Menu Utama -->
    <section id="menu-utama" class="py-16 bg-slate-50 border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">Layanan Digital</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Menu Utama Anggota</h2>
                <p class="text-slate-500 mt-3">Akses seluruh modul dan administrasi finansial mandiri Anda secara instan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Simpanan -->
                <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <span class="text-xl">💰</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Simpanan Anggota</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Cek mutasi saldo simpanan pokok, wajib, dan sukarela Anda.</p>
                </a>

                <!-- Pinjaman -->
              <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <span class="text-xl">💳</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Ajukan Pinjaman</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Simulasi kalkulator pinjaman serta form pengajuan online baru.</p>
                </a>

                <!-- Transaksi -->
                <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <span class="text-xl">📄</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Setor / Tarik Dana</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Buat permintaan transaksi penyetoran deposit atau pencairan dana.</p>
                </a>

                <!-- Riwayat -->
                <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <span class="text-xl">📊</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Riwayat Aktivitas</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Pantau histori persetujuan admin dan log audit rekening Anda.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Informasi Visi Misi Koperasi -->
    <section id="informasi" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-50 rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-sm max-w-4xl mx-auto">
                <div class="text-center max-w-xl mx-auto mb-10">
                    <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">Profil Koperasi</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Visi & Misi KSP Sejahtera Mandiri</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-4 bg-emerald-500 rounded-full"></span>
                            <h4 class="font-bold text-slate-900">Visi Kami</h4>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Menjadi koperasi modern yang terpercaya, profesional, transparan dan mampu meningkatkan kesejahteraan seluruh anggota secara berkelanjutan.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-4 bg-emerald-500 rounded-full"></span>
                            <h4 class="font-bold text-slate-900">Misi Utama</h4>
                        </div>
                        <ul class="space-y-2.5 text-sm text-slate-600">
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 shrink-0">✔</span>
                                <span>Menjamin keamanan penuh dana simpanan seluruh anggota.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 shrink-0">✔</span>
                                <span>Menyalurkan fasilitas pinjaman dengan bunga yang ringan & adil.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 shrink-0">✔</span>
                                <span>Menerapkan keterbukaan transaksi berbasis teknologi real-time.</span>
                            </li>
                        </ul>
                    </div>
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