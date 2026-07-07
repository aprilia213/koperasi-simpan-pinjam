<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Left Side: Interactive Cooperative Branding (Desktop only) -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-emerald-800 to-green-950 text-white p-12 flex-col justify-between relative overflow-hidden">
                <!-- Background decorative shapes -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -ml-20 -mb-20"></div>
                
                <!-- Logo & Brand Name -->
                <div class="flex items-center gap-3 relative z-10">
                    <x-application-logo class="w-12 h-12 text-white" />
                    <span class="text-xl font-bold tracking-wider">KSP SEJAHTERA MANDIRI</span>
                </div>
                
                <!-- Center Content: Slogan and Stats -->
                <div class="my-auto relative z-10 max-w-lg">
                    <span class="text-emerald-400 font-semibold uppercase tracking-wider text-sm">Koperasi Simpan Pinjam</span>
                    <h2 class="text-4xl font-extrabold mt-2 leading-tight">
                        Tumbuh Bersama, Menyejahterakan Anggota
                    </h2>
                    <p class="text-emerald-100 mt-4 leading-relaxed">
                        Bergabunglah dengan KSP Sejahtera Mandiri untuk mengelola simpanan, mendapatkan akses pinjaman dengan bunga ringan, serta menikmati bagi hasil (SHU) yang adil berbasis kekeluargaan.
                    </p>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-6 mt-8 pt-8 border-t border-emerald-700">
                        <div>
                            <span class="block text-3xl font-bold text-white">12.500+</span>
                            <span class="text-xs text-emerald-300 uppercase tracking-wider font-semibold">Anggota Aktif</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-bold text-white">85 Miliar+</span>
                            <span class="text-xs text-emerald-300 uppercase tracking-wider font-semibold">Total Aset Koperasi</span>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Info -->
                <div class="text-emerald-400 text-xs relative z-10 flex justify-between">
                    <span>Terdaftar & Diawasi oleh Kemenkop UKM</span>
                    <span>&copy; {{ date('Y') }} KSP Sejahtera Mandiri</span>
                </div>
            </div>

            <!-- Right Side: Forms (Login/Register/Verify/OTP) -->
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-12 lg:w-1/2 bg-white">
                <!-- Small Logo for Mobile/Tablet -->
                <div class="lg:hidden mb-6 flex flex-col items-center">
                    <a href="/" class="flex flex-col items-center gap-2">
                        <x-application-logo class="w-16 h-16 text-emerald-600" />
                        <span class="text-lg font-bold tracking-wider text-slate-800 uppercase mt-1">KSP Sejahtera Mandiri</span>
                    </a>
                </div>

                <!-- Form container -->
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>