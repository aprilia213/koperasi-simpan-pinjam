<nav x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'shadow-lg' : 'shadow-sm'"
    class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-slate-200 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div :class="scrolled ? 'h-16' : 'h-20'"
            class="flex items-center justify-between transition-all duration-300">

            <!-- Logo -->
            <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                class="flex items-center gap-3">

                <div :class="scrolled ? 'w-10 h-10' : 'w-12 h-12'"
                    class="transition-all duration-300">

                    <x-application-logo class="w-full h-full text-emerald-600"/>

                </div>

                <div>

                    <h1 :class="scrolled ? 'text-base' : 'text-lg'"
                        class="font-extrabold text-slate-800 uppercase tracking-wide transition-all duration-300">

                        KSP Sejahtera

                    </h1>

                    <p :class="scrolled ? 'hidden' : 'block'"
                        class="text-xs text-slate-500">

                        Koperasi Simpan Pinjam

                    </p>

                </div>

            </a>

            <!-- MENU -->
            <div class="hidden lg:flex items-center gap-2">

                @if(Auth::user()->isAdmin())

                    <x-nav-link
                        :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.anggota')"
                        :active="request()->routeIs('admin.anggota')">
                        Anggota
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.simpananadmin')"
                        :active="request()->routeIs('admin.simpananadmin')">
                        Simpanan
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.pinjamanadmin')"
                        :active="request()->routeIs('admin.pinjamanadmin')">
                        Pinjaman
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.transaksi.index')"
                        :active="request()->routeIs('admin.transaksi.index')">
                        Verifikasi Transaksi
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.laporan')"
                        :active="request()->routeIs('admin.laporan')">
                        Laporan
                    </x-nav-link>

                @else

                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('simpanan')"
                        :active="request()->routeIs('simpanan')">
                        Simpanan
                    </x-nav-link>

                    <x-nav-link
                        :href="route('pinjaman')"
                        :active="request()->routeIs('pinjaman')">
                        Pinjaman
                    </x-nav-link>

                    <x-nav-link
                        :href="route('transaksi.index')"
                        :active="request()->routeIs('transaksi.index')">
                        Bayar Angsuran
                    </x-nav-link>

                    <!-- <x-nav-link
                        :href="route('riwayat')"
                        :active="request()->routeIs('riwayat')">
                        Riwayat
                    </x-nav-link> -->

                @endif

            </div>

            <!-- USER DROPDOWN -->
            <div class="hidden lg:flex lg:items-center">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                            <div>

                                {{ Auth::user()->name }}

                            </div>

                            <div class="ml-2">

                                <svg class="fill-current h-4 w-4"
                                    viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd"/>

                                </svg>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-3 border-b">

                            <div class="font-semibold">

                                {{ Auth::user()->name }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ Auth::user()->email }}

                            </div>

                        </div>

                        <x-dropdown-link :href="route('profile.edit')">

                            Profile

                        </x-dropdown-link>

                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile -->
            <div class="flex items-center lg:hidden">

                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-500 hover:text-gray-700">

                    <svg class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            :class="{ 'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>

                        <path
                            :class="{ 'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div x-show="open"
        class="lg:hidden bg-white border-t">

        <div class="pt-2 pb-3 space-y-1">

            @if(Auth::user()->isAdmin())

                <x-responsive-nav-link :href="route('admin.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.anggota')">
                    Anggota
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.simpananadmin')">
                    Simpanan
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.pinjamanadmin')">
                    Pinjaman
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.transaksi.index')">
                    Verifikasi Transaksi
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.laporan')">
                    Laporan
                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link :href="route('dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('simpanan')">
                    Simpanan
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('pinjaman')">
                    Pinjaman
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('transaksi.index')">
                    Bayar Angsuran
                </x-responsive-nav-link>

                <!-- <x-responsive-nav-link :href="route('riwayat')">
                    Riwayat
                </x-responsive-nav-link> -->

            @endif

        </div>

        <div class="border-t border-gray-200">

            <div class="px-4 py-3">

                <div class="font-medium">

                    {{ Auth::user()->name }}

                </div>

                <div class="text-sm text-gray-500">

                    {{ Auth::user()->email }}

                </div>

            </div>

            <x-responsive-nav-link :href="route('profile.edit')">
                Profile
            </x-responsive-nav-link>

            <form method="POST"
                action="{{ route('logout') }}">

                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">

                    Logout

                </x-responsive-nav-link>

            </form>

        </div>

    </div>

</nav>