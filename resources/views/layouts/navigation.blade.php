<nav
    x-data="{
        open: false,
        scrolled: false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 10
        })
    "
    :class="scrolled ? 'shadow-lg' : 'shadow-sm'"
    class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-slate-200 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            :class="scrolled ? 'h-16' : 'h-20'"
            class="flex items-center justify-between transition-all duration-300">

            <!-- Logo -->
            <div class="flex items-center gap-10">

                <a
                    href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                    class="flex items-center gap-3">

                    <div
                        :class="scrolled ? 'w-10 h-10' : 'w-12 h-12'"
                        class="transition-all duration-300">

                        <x-application-logo class="w-full h-full text-emerald-600"/>

                    </div>

                    <div>

                        <h1
                            :class="scrolled ? 'text-base' : 'text-lg'"
                            class="font-extrabold text-slate-800 uppercase tracking-wide transition-all duration-300">

                            KSP Sejahtera

                        </h1>

                        <p
                            :class="scrolled ? 'hidden' : 'block'"
                            class="text-xs text-slate-500">

                            Koperasi Simpan Pinjam

                        </p>

                    </div>

                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-2">

                    @if(Auth::user()->isAdmin())

                        <x-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link href="#">
                            Anggota
                        </x-nav-link>

                        <x-nav-link href="#">
                            Simpanan
                        </x-nav-link>

                        <x-nav-link href="#">
                            Pinjaman
                        </x-nav-link>

                        <x-nav-link href="#">
                            Transaksi
                        </x-nav-link>

                        <x-nav-link href="#">
                            Laporan
                        </x-nav-link>

                    @else

                        <x-nav-link
                            :href="route('dashboard')"
                            :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link href="#">
                            Simpanan
                        </x-nav-link>

                        <x-nav-link href="#">
                            Pinjaman
                        </x-nav-link>

                        <x-nav-link href="#">
                            Transaksi
                        </x-nav-link>

                        <x-nav-link href="#">
                            Riwayat
                        </x-nav-link>

                    @endif

                </div>

            </div>

            <!-- User Dropdown -->
            <div class="hidden lg:flex items-center">

                <x-dropdown align="right" width="60">

                    <x-slot name="trigger">

                        <button
                            :class="scrolled ? 'py-1.5 px-3' : 'py-2 px-4'"
                            class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white hover:shadow-md transition-all duration-300">

                            <div class="w-10 h-10 rounded-full flex items-center justify-center
                                {{ Auth::user()->isAdmin() ? 'bg-red-100' : 'bg-emerald-100' }}">

                                <span class="font-bold
                                    {{ Auth::user()->isAdmin() ? 'text-red-700' : 'text-emerald-700' }}">

                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                                </span>

                            </div>

                            <div class="text-left">

                                <div class="font-semibold text-slate-800">

                                    {{ Auth::user()->name }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    {{ Auth::user()->isAdmin() ? 'Administrator' : 'Anggota' }}

                                </div>

                            </div>

                            <svg
                                class="w-4 h-4 text-slate-500"
                                fill="currentColor"
                                viewBox="0 0 20 20">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"/>

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-3 border-b">

                            <div class="font-semibold">

                                {{ Auth::user()->name }}

                            </div>

                            <div class="text-sm text-slate-500">

                                {{ Auth::user()->email }}

                            </div>

                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Logout
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Hamburger -->
            <div class="lg:hidden">

                <button
                    @click="open = !open"
                    class="p-2 rounded-lg hover:bg-slate-100 transition">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            :class="{ 'hidden': open, 'block': !open }"
                            class="block"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>

                        <path
                            :class="{ 'block': open, 'hidden': !open }"
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

    <!-- Mobile Menu -->
    <div
        x-show="open"
        x-transition
        class="lg:hidden bg-white border-t border-slate-200">
                <div class="py-3 space-y-1">

            <!-- User Info -->
            <div class="px-4 py-4 border-b flex items-center gap-3">

                <div class="w-10 h-10 rounded-full flex items-center justify-center
                    {{ Auth::user()->isAdmin() ? 'bg-red-100' : 'bg-emerald-100' }}">

                    <span class="font-bold
                        {{ Auth::user()->isAdmin() ? 'text-red-700' : 'text-emerald-700' }}">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </span>

                </div>

                <div>

                    <div class="font-semibold text-slate-800">

                        {{ Auth::user()->name }}

                    </div>

                    <div class="text-sm text-slate-500">

                        {{ Auth::user()->email }}

                    </div>

                    <div class="text-xs mt-1
                        {{ Auth::user()->isAdmin() ? 'text-red-600' : 'text-emerald-600' }}">

                        {{ Auth::user()->isAdmin() ? 'Administrator' : 'Anggota' }}

                    </div>

                </div>

            </div>

            @if(Auth::user()->isAdmin())

                <x-responsive-nav-link
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')">

                    Dashboard

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Anggota

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Simpanan

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Pinjaman

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Transaksi

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Laporan

                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')">

                    Dashboard

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Simpanan

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Pinjaman

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Transaksi

                </x-responsive-nav-link>

                <x-responsive-nav-link href="#">

                    Riwayat

                </x-responsive-nav-link>

            @endif

            <div class="border-t border-slate-200 my-2"></div>

            <x-responsive-nav-link
                :href="route('profile.edit')">

                👤 Profile

            </x-responsive-nav-link>

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">

                    🚪 Logout

                </x-responsive-nav-link>

            </form>

        </div>

    </div>

</nav>