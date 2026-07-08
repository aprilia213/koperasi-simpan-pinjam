<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>KSP Sejahtera Mandiri - Tumbuh Bersama, Menyejahterakan Anggota</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800" x-data="{ openMobileMenu: false }">

        <!-- Top Header Navigation -->
        <header class="sticky top-0 z-50 bg-white/85 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 sm:h-20">
                    <!-- Logo and Brand -->
                    <div class="flex items-center gap-3">
                        <a href="/" class="flex items-center gap-2">
                            <x-application-logo class="w-10 h-10 text-emerald-600" />
                            <span class="text-lg sm:text-xl font-extrabold tracking-wider text-slate-800 uppercase">KSP Sejahtera</span>
                        </a>
                    </div>

                    <!-- Navigation Links (Desktop) -->
                    <nav class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Layanan</a>
                        <a href="#simulator" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Simulasi</a>
                        <a href="#stats" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Statistik</a>
                        <a href="#faq" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Tanya Jawab</a>
                    </nav>

                    <!-- CTAs (Desktop) -->
                    <div class="hidden md:flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-lg transition-all">
                                        Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-lg transition-all">
                                        Dashboard Anggota
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-emerald-600 transition-colors px-4 py-2">
                                    Masuk Sesi
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-lg transition-all">
                                        Gabung Anggota
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button @click="openMobileMenu = !openMobileMenu" type="button" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-emerald-600 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                            <span class="sr-only">Buka menu utama</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path :class="{'hidden': openMobileMenu, 'block': !openMobileMenu }" class="block" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'block': openMobileMenu, 'hidden': !openMobileMenu }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="openMobileMenu" x-collapse x-cloak class="md:hidden bg-white border-b border-slate-100">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#features" @click="openMobileMenu = false" class="block px-3 py-2 rounded-xl text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-600">Layanan</a>
                    <a href="#simulator" @click="openMobileMenu = false" class="block px-3 py-2 rounded-xl text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-600">Simulasi</a>
                    <a href="#stats" @click="openMobileMenu = false" class="block px-3 py-2 rounded-xl text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-600">Statistik</a>
                    <a href="#faq" @click="openMobileMenu = false" class="block px-3 py-2 rounded-xl text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-600">Tanya Jawab</a>
                </div>
                <div class="pt-4 pb-4 border-t border-slate-100 px-5 flex flex-col gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="w-full text-center py-2.5 rounded-xl text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="w-full text-center py-2.5 rounded-xl text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md">
                                Dashboard Anggota
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl text-base font-bold text-slate-700 hover:bg-slate-50">
                            Masuk Sesi
                        </a>
                        <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md">
                            Gabung Anggota
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative bg-white overflow-hidden py-16 sm:py-24 lg:py-32">
            <!-- Decorative Background Graphic -->
            <div class="absolute top-0 right-0 -mr-40 w-[600px] h-[600px] bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                    
                    <!-- Hero Content -->
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Terdaftar & Diawasi Kemenkop UKM
                        </span>
                        
                        <h1 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-tight">
                            Solusi Finansial Aman, <br class="hidden sm:inline">
                            <span class="text-emerald-600">Tumbuh Bersama</span> Koperasi
                        </h1>
                        
                        <p class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed">
                            KSP Sejahtera Mandiri menghadirkan wadah pengelolaan dana yang transparan, amanah, dan mengutamakan kesejahteraan anggota. Dapatkan pinjaman bunga ringan dan pembagian SHU tahunan yang adil berbasis gotong royong.
                        </p>
                        
                        <div class="mt-8 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-4">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-600/30 hover:shadow-xl transition-all">
                                Gabung Sekarang
                            </a>
                            <a href="#simulator" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition-all">
                                Simulasi Pembiayaan
                            </a>
                        </div>

                        <!-- Trust indicators -->
                        <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-3 gap-4">
                            <div>
                                <span class="block text-2xl font-extrabold text-slate-900">0.8%</span>
                                <span class="text-xs text-slate-500">Bunga Pinjaman Flat / Bln</span>
                            </div>
                            <div>
                                <span class="block text-2xl font-extrabold text-slate-900">100%</span>
                                <span class="text-xs text-slate-500">Transparan & Kekeluargaan</span>
                            </div>
                            <div>
                                <span class="block text-2xl font-extrabold text-slate-900">24 Jam</span>
                                <span class="text-xs text-slate-500">Akses Dashboard Aman</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Visual Content (Mockup/Illustration card) -->
                    <div class="mt-12 sm:mt-16 lg:mt-0 lg:col-span-5 relative flex justify-center">
                        <div class="relative w-full max-w-sm sm:max-w-md bg-gradient-to-br from-emerald-800 to-green-950 rounded-3xl p-8 text-white shadow-2xl overflow-hidden">
                            <!-- Background Circles -->
                            <div class="absolute -right-20 -top-20 w-60 h-60 bg-emerald-700/30 rounded-full filter blur-xl"></div>
                            <div class="absolute -left-20 -bottom-20 w-60 h-60 bg-green-700/30 rounded-full filter blur-xl"></div>

                            <div class="flex justify-between items-start mb-12 relative z-10">
                                <div>
                                    <span class="text-emerald-300 font-semibold text-xs tracking-wider uppercase block">Kartu Anggota Digital</span>
                                    <span class="text-xl font-bold tracking-wide mt-1 block">KSP Sejahtera</span>
                                </div>
                                <x-application-logo class="w-10 h-10 text-white" />
                            </div>

                            <div class="mb-12 relative z-10">
                                <span class="text-emerald-200 text-xs tracking-widest block uppercase">Saldo Simpanan Utama</span>
                                <span class="text-3xl sm:text-4xl font-extrabold tracking-wide mt-1 block">Rp 24.500.000</span>
                            </div>

                            <div class="flex justify-between items-end relative z-10">
                                <div>
                                    <span class="text-emerald-300 text-xs block">ID Anggota</span>
                                    <span class="font-mono text-sm tracking-widest">KSP-2026-0707</span>
                                </div>
                                <div class="bg-white/10 px-3 py-1.5 rounded-lg border border-white/20 backdrop-blur-md">
                                    <span class="text-xs font-semibold text-emerald-300">Status: Aktif</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating decoration card -->
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-3 max-w-xs animate-bounce" style="animation-duration: 4s;">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800">SHU Masuk</span>
                                <span class="text-xs text-slate-400">Rp 1.250.000 dibagikan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services / Features Section -->
        <section id="features" class="py-16 sm:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">Layanan Unggulan</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">
                        Produk & Layanan Keuangan Anggota
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Kami menyediakan berbagai layanan simpan-pinjam fleksibel yang dirancang untuk mendukung kebutuhan rumah tangga, bisnis kecil, dan investasi masa depan Anda.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1: Simpanan Sukarela -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M3.75 20.25zM3.75 20.25h16.5M21.75 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Simpanan Sukarela</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Simpanan bebas biaya administrasi bulanan dengan setoran dan penarikan yang fleksibel kapan saja Anda butuhkan.
                        </p>
                    </div>

                    <!-- Feature 2: Simpanan Berjangka -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Simpanan Berjangka</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Investasikan dana Anda secara berjangka dengan bunga bagi hasil yang lebih kompetitif dan jangka waktu fleksibel.
                        </p>
                    </div>

                    <!-- Feature 3: Pinjaman Mudah -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Pinjaman Fleksibel</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Pengajuan pinjaman dana cepat untuk kebutuhan konsumtif atau produktif UMKM dengan syarat mudah & bunga rendah.
                        </p>
                    </div>

                    <!-- Feature 4: Bagi Hasil (SHU) -->
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a3 3 0 00-3-3H9.75a3 3 0 00-3 3m12 0a3 3 0 01-3 3H18a3 3 0 01-3-3m-6 3h6M12 3a9 9 0 110 18 9 9 0 010-18z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Sisa Hasil Usaha</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Nikmati keuntungan sisa hasil usaha (SHU) tahunan yang didistribusikan secara transparan kepada seluruh anggota aktif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Loan & Savings Simulator (Interactive Calculator) -->
        <section id="simulator" class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">Simulasi Mandiri</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">
                        Kalkulator Simulasi Keuangan
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Gunakan simulator interaktif kami untuk menghitung perkiraan simpanan berjangka Anda atau angsuran bulanan rencana pinjaman Anda.
                    </p>
                </div>

                <!-- Calculator Body -->
                <div class="bg-slate-50 rounded-3xl p-6 sm:p-10 lg:p-12 border border-slate-100 shadow-xl max-w-4xl mx-auto"
                     x-data="{ 
                        type: 'loan',
                        amount: 5000000, 
                        tenor: 12, 
                        rateLoan: 0.008, 
                        rateSavings: 0.005,
                        formatRupiah(value) {
                            return 'Rp ' + Number(value).toLocaleString('id-ID');
                        },
                        get monthlyPrincipal() {
                            return this.amount / this.tenor;
                        },
                        get monthlyInterest() {
                            return this.amount * this.rateLoan;
                        },
                        get monthlyInstallment() {
                            return Math.round(this.monthlyPrincipal + this.monthlyInterest);
                        },
                        get totalRepayment() {
                            return this.monthlyInstallment * this.tenor;
                        },
                        get totalInterest() {
                            return this.monthlyInterest * this.tenor;
                        },
                        get savingsProjectedInterest() {
                            return this.amount * this.rateSavings * this.tenor;
                        },
                        get savingsProjectedTotal() {
                            return Number(this.amount) + this.savingsProjectedInterest;
                        }
                     }">
                     
                    <!-- Simulator Type Switcher -->
                    <div class="flex justify-center mb-10">
                        <div class="bg-slate-200 p-1.5 rounded-2xl flex gap-1">
                            <button @click="type = 'loan'" 
                                    :class="type === 'loan' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:text-slate-900'" 
                                    class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all duration-200">
                                Simulasi Pinjaman
                            </button>
                            <button @click="type = 'savings'" 
                                    :class="type === 'savings' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:text-slate-900'" 
                                    class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all duration-200">
                                Simulasi Simpanan
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
                        <!-- Inputs Column -->
                        <div class="lg:col-span-7 flex flex-col justify-between">
                            <!-- Amount Slider -->
                            <div class="mb-8">
                                <div class="flex justify-between items-center mb-3">
                                    <label class="font-bold text-slate-800" x-text="type === 'loan' ? 'Jumlah Pinjaman' : 'Jumlah Simpanan Awal'"></label>
                                    <span class="text-emerald-700 font-extrabold text-lg" x-text="formatRupiah(amount)"></span>
                                </div>
                                <input type="range" 
                                       x-model="amount" 
                                       min="1000000" 
                                       max="100000000" 
                                       step="1000000" 
                                       class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-emerald-600 focus:outline-none">
                                <div class="flex justify-between text-xs text-slate-400 mt-2">
                                    <span>Rp 1 Juta</span>
                                    <span>Rp 100 Juta</span>
                                </div>
                            </div>

                            <!-- Tenor / Duration -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-3" x-text="type === 'loan' ? 'Jangka Waktu Angsuran' : 'Jangka Waktu Deposito'"></label>
                                <div class="grid grid-cols-5 gap-2">
                                    <template x-for="t in [3, 6, 12, 24, 36]">
                                        <button @click="tenor = t"
                                                :class="tenor == t ? 'bg-emerald-600 border-emerald-600 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50'"
                                                class="py-3 px-2 border rounded-xl font-bold text-sm transition-all text-center">
                                            <span x-text="t"></span> <br>
                                            <span class="text-[10px] font-normal" x-text="type === 'loan' ? 'Bulan' : 'Bulan'"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <!-- Interactive info footer -->
                            <div class="mt-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 111.063.854l-.041.02a.75.75 0 01-1.063-.854zm0 0a.75.75 0 100-1.5.75.75 0 000 1.5zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-emerald-800 leading-relaxed" x-show="type === 'loan'">
                                    *Simulasi di atas menggunakan estimasi bunga pembiayaan flat <strong>0.8% per bulan</strong>. Persetujuan pinjaman tunduk pada proses verifikasi profil kelayakan anggota.
                                </p>
                                <p class="text-xs text-emerald-800 leading-relaxed" x-show="type === 'savings'">
                                    *Simulasi di atas menggunakan estimasi bagi hasil simpanan berjangka flat <strong>0.5% per bulan</strong> (6% per tahun). Hasil yang dibagikan belum termasuk pemotongan zakat koperasi jika ada.
                                </p>
                            </div>
                        </div>

                        <!-- Results Card Column -->
                        <div class="lg:col-span-5 flex">
                            <!-- Loan Simulation Results -->
                            <div x-show="type === 'loan'" 
                                 class="w-full bg-gradient-to-br from-emerald-800 to-green-950 rounded-2xl p-6 sm:p-8 text-white flex flex-col justify-between shadow-lg relative overflow-hidden">
                                <div class="absolute right-0 bottom-0 w-40 h-40 bg-emerald-700/10 rounded-full filter blur-xl"></div>
                                
                                <div>
                                    <span class="text-emerald-300 text-xs font-semibold uppercase tracking-wider block">Estimasi Angsuran Bulanan</span>
                                    <span class="text-4xl font-extrabold tracking-wide mt-2 block" x-text="formatRupiah(monthlyInstallment)"></span>
                                    <span class="text-emerald-200 text-xs block mt-1">sudah termasuk pokok + bunga flat</span>
                                </div>

                                <div class="mt-8 space-y-4 pt-6 border-t border-emerald-700/60">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Total Pinjaman</span>
                                        <span class="font-bold text-white" x-text="formatRupiah(amount)"></span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Bunga flat (0.8%)</span>
                                        <span class="font-bold text-white" x-text="formatRupiah(totalInterest)"></span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Durasi Angsuran</span>
                                        <span class="font-bold text-white" x-text="tenor + ' Bulan'"></span>
                                    </div>
                                    <div class="flex justify-between text-base pt-3 border-t border-emerald-700/40">
                                        <span class="text-emerald-200 font-semibold">Total Pengembalian</span>
                                        <span class="font-bold text-emerald-400" x-text="formatRupiah(totalRepayment)"></span>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center py-3 bg-white hover:bg-emerald-50 text-emerald-950 font-bold rounded-xl text-sm transition-all shadow-md">
                                        Ajukan Pinjaman
                                    </a>
                                </div>
                            </div>

                            <!-- Savings Simulation Results -->
                            <div x-show="type === 'savings'" 
                                 class="w-full bg-gradient-to-br from-emerald-800 to-green-950 rounded-2xl p-6 sm:p-8 text-white flex flex-col justify-between shadow-lg relative overflow-hidden">
                                <div class="absolute right-0 bottom-0 w-40 h-40 bg-emerald-700/10 rounded-full filter blur-xl"></div>
                                
                                <div>
                                    <span class="text-emerald-300 text-xs font-semibold uppercase tracking-wider block">Estimasi Dana Akhir</span>
                                    <span class="text-4xl font-extrabold tracking-wide mt-2 block" x-text="formatRupiah(savingsProjectedTotal)"></span>
                                    <span class="text-emerald-200 text-xs block mt-1">Pokok awal + akumulasi bagi hasil</span>
                                </div>

                                <div class="mt-8 space-y-4 pt-6 border-t border-emerald-700/60">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Simpanan Pokok</span>
                                        <span class="font-bold text-white" x-text="formatRupiah(amount)"></span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Estimasi Bagi Hasil</span>
                                        <span class="font-bold text-emerald-400" x-text="'+ ' + formatRupiah(savingsProjectedInterest)"></span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-emerald-200">Jangka Waktu</span>
                                        <span class="font-bold text-white" x-text="tenor + ' Bulan'"></span>
                                    </div>
                                    <div class="flex justify-between text-base pt-3 border-t border-emerald-700/40">
                                        <span class="text-emerald-200 font-semibold">Tingkat SHU Efektif</span>
                                        <span class="font-bold text-white">6% per tahun</span>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center py-3 bg-white hover:bg-emerald-50 text-emerald-950 font-bold rounded-xl text-sm transition-all shadow-md">
                                        Mulai Menyimpan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="stats" class="py-16 sm:py-24 bg-gradient-to-br from-emerald-800 to-green-950 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-slate-950 opacity-10 -z-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                    
                    <!-- Stats copy -->
                    <div class="mb-12 lg:mb-0">
                        <span class="text-emerald-400 font-bold uppercase tracking-wider text-sm">Kredibilitas & Kepercayaan</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2 leading-tight">
                            Mengabdi untuk Kesejahteraan Finansial Anggota
                        </h2>
                        <p class="text-emerald-100 mt-4 leading-relaxed">
                            KSP Sejahtera Mandiri didirikan dengan prinsip transparansi penuh dan kekeluargaan. Kami beroperasi di bawah payung regulasi Kementerian Koperasi dan UKM RI, memastikan seluruh modal disimpan secara produktif demi kemakmuran bersama.
                        </p>
                        <div class="mt-8 flex gap-4">
                            <div class="bg-white/10 px-4 py-3 rounded-2xl border border-white/10">
                                <span class="font-bold block text-sm">SIUP Koperasi</span>
                                <span class="text-xs text-emerald-300">No. 518/142.KSP/2022</span>
                            </div>
                            <div class="bg-white/10 px-4 py-3 rounded-2xl border border-white/10">
                                <span class="font-bold block text-sm">Sertifikasi Asosiasi</span>
                                <span class="text-xs text-emerald-300">Peringkat Koperasi A (Sehat)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Counter Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-md">
                            <span class="block text-4xl sm:text-5xl font-extrabold text-white">12.500+</span>
                            <span class="block text-sm font-semibold text-emerald-300 uppercase tracking-wider mt-2">Anggota Terdaftar</span>
                            <p class="text-xs text-emerald-100/70 mt-1">Anggota aktif yang menaruh kepercayaan keuangan pada kami.</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-md">
                            <span class="block text-4xl sm:text-5xl font-extrabold text-white">Rp 85 M+</span>
                            <span class="block text-sm font-semibold text-emerald-300 uppercase tracking-wider mt-2">Total Aset Dikelola</span>
                            <p class="text-xs text-emerald-100/70 mt-1">Menggambarkan likuiditas kuat dan pengelolaan yang amanah.</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-md">
                            <span class="block text-4xl sm:text-5xl font-extrabold text-white">100%</span>
                            <span class="block text-sm font-semibold text-emerald-300 uppercase tracking-wider mt-2">Bagi Hasil Adil</span>
                            <p class="text-xs text-emerald-100/70 mt-1">Pembagian Sisa Hasil Usaha (SHU) rutin setiap tahun kepada anggota.</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-md">
                            <span class="block text-4xl sm:text-5xl font-extrabold text-white">1 Hari</span>
                            <span class="block text-sm font-semibold text-emerald-300 uppercase tracking-wider mt-2">Pencairan Pembiayaan</span>
                            <p class="text-xs text-emerald-100/70 mt-1">Proses peninjauan cepat begitu berkas persyaratan disetujui.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-16 sm:py-24 bg-slate-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ activeFaq: null }">
                <div class="text-center mb-16">
                    <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">FAQ Koperasi</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-2">
                        Pertanyaan Umum
                    </h2>
                    <p class="text-slate-500 mt-3">
                        Berikut beberapa informasi dasar yang sering ditanyakan mengenai keanggotaan dan operasional KSP Sejahtera Mandiri.
                    </p>
                </div>

                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                        <button @click="activeFaq = activeFaq === 1 ? null : 1" 
                                class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
                            <span class="font-bold text-slate-800">Bagaimana syarat bergabung menjadi anggota KSP?</span>
                            <svg :class="activeFaq === 1 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" 
                                 class="w-5 h-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 1" x-collapse class="px-6 pb-6 text-sm text-slate-500 leading-relaxed border-t border-slate-50 pt-4">
                            Untuk menjadi anggota, Anda cukup mendaftarkan diri secara online melalui website ini, mengunggah foto KTP, serta melakukan setoran Simpanan Pokok dan Simpanan Wajib awal sesuai dengan ketentuan AD/ART koperasi.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                        <button @click="activeFaq = activeFaq === 2 ? null : 2" 
                                class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
                            <span class="font-bold text-slate-800">Apakah simpanan saya di KSP aman?</span>
                            <svg :class="activeFaq === 2 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" 
                                 class="w-5 h-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 2" x-collapse class="px-6 pb-6 text-sm text-slate-500 leading-relaxed border-t border-slate-50 pt-4">
                            Sangat aman. KSP Sejahtera Mandiri beroperasi di bawah legalitas hukum koperasi resmi dan pengawasan Kementerian Koperasi & UKM. Manajemen dana kami audit secara berkala oleh Akuntan Publik independen untuk meminimalisir risiko.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                        <button @click="activeFaq = activeFaq === 3 ? null : 3" 
                                class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
                            <span class="font-bold text-slate-800">Berapa besar bagi hasil SHU yang akan saya dapatkan?</span>
                            <svg :class="activeFaq === 3 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" 
                                 class="w-5 h-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 3" x-collapse class="px-6 pb-6 text-sm text-slate-500 leading-relaxed border-t border-slate-50 pt-4">
                            Besaran SHU (Sisa Hasil Usaha) ditentukan berdasarkan performa laba koperasi di akhir tahun buku. SHU dibagikan secara adil berdasarkan proporsi kontribusi simpanan dan aktivitas pinjaman/transaksi yang Anda lakukan selama satu tahun.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                        <button @click="activeFaq = activeFaq === 4 ? null : 4" 
                                class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
                            <span class="font-bold text-slate-800">Bagaimana proses pengajuan pinjaman/pembiayaan?</span>
                            <svg :class="activeFaq === 4 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" 
                                 class="w-5 h-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 4" x-collapse class="px-6 pb-6 text-sm text-slate-500 leading-relaxed border-t border-slate-50 pt-4">
                            Anggota aktif dapat mengajukan pinjaman langsung melalui Dashboard Anggota. Setelah mengisi nominal dan jangka waktu serta melengkapi data pendukung, tim analis koperasi akan melakukan peninjauan dalam waktu 1-2 hari kerja.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 sm:py-20 bg-emerald-600 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-green-800 opacity-50 -z-10"></div>
            
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl sm:text-4xl font-extrabold">Siap Menjadi Bagian Dari Koperasi Kami?</h2>
                <p class="text-emerald-100 mt-4 max-w-2xl mx-auto text-base sm:text-lg">
                    Daftar sebagai anggota hari ini untuk mulai merencanakan keuangan masa depan Anda secara mandiri, aman, dan berazaskan gotong royong kekeluargaan.
                </p>
                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-emerald-50 text-emerald-950 font-extrabold rounded-xl text-base shadow-lg transition-all duration-200">
                        Gabung Keanggotaan Sekarang
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-8 pb-8 border-b border-slate-800">
                    
                    <!-- Branding Col -->
                    <div class="md:col-span-5">
                        <div class="flex items-center gap-2 mb-4">
                            <x-application-logo class="w-8 h-8 text-emerald-500" />
                            <span class="text-lg font-bold text-white uppercase tracking-wider">KSP Sejahtera</span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Koperasi Simpan Pinjam Sejahtera Mandiri berdedikasi untuk memberikan pelayanan finansial terbaik yang amanah, transparan, dan menyejahterakan seluruh anggota koperasi.
                        </p>
                        <span class="text-xs text-slate-500 block">Badan Hukum Koperasi: No. 518/142.KSP/2022</span>
                    </div>

                    <!-- Products Col -->
                    <div class="md:col-span-3">
                        <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Layanan Finansial</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#features" class="hover:text-emerald-500 transition-colors">Simpanan Sukarela</a></li>
                            <li><a href="#features" class="hover:text-emerald-500 transition-colors">Simpanan Berjangka (Deposito)</a></li>
                            <li><a href="#features" class="hover:text-emerald-500 transition-colors">Pembiayaan UMKM</a></li>
                            <li><a href="#features" class="hover:text-emerald-500 transition-colors">Pinjaman Konsumtif Ringan</a></li>
                        </ul>
                    </div>

                    <!-- Contact Col -->
                    <div class="md:col-span-4">
                        <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Kantor Pusat</h4>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Jl. Koperasi No. 12, Area Perkantoran Ekonomi, Jakarta Selatan, Indonesia.
                        </p>
                        <div class="mt-4 space-y-1 text-sm text-slate-400">
                            <span class="block">Email: support@ksp-sejahtera.co.id</span>
                            <span class="block">Telepon: (021) 555-KOPERASI</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500">
                    <span>&copy; {{ date('Y') }} KSP Sejahtera Mandiri. Seluruh hak cipta dilindungi undang-undang.</span>
                    <div class="flex gap-4 mt-2 sm:mt-0">
                        <span class="hover:text-slate-400 cursor-default">Syarat & Ketentuan</span>
                        <span class="hover:text-slate-400 cursor-default">Kebijakan Privasi</span>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
