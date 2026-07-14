<x-app-layout>
<section class="relative overflow-hidden bg-gradient-to-br from-white via-emerald-50 to-green-100 py-14 sm:py-24">
    <div class="absolute -top-20 -right-20 w-[400px] h-[400px] bg-emerald-200/40 rounded-full blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
            <div>
                <span class="inline-flex px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-widest">
                    Pinjaman Anggota
                </span>

                <h1 class="mt-5 text-4xl font-extrabold text-slate-900">
                    Kelola Pinjaman Anda
                </h1>

                <p class="mt-3 text-slate-600 max-w-xl">
                    Ajukan pinjaman, lihat status persetujuan,
                    dan pantau riwayat pinjaman Anda secara transparan.
                </p>
            </div>

            <div>
                <a href="{{ route('pinjaman-create') }}" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg transition">
                    💳 Ajukan Pinjaman
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pinjaman -->
            <div class="bg-gradient-to-br from-emerald-600 to-green-700 rounded-3xl p-6 text-white shadow-xl">
                <p class="text-sm text-emerald-100">
                    Total Pinjaman
                </p>

                <h2 class="mt-4 text-3xl font-extrabold">
                    Rp {{ number_format($pinjaman->sum('jumlah_pinjaman'),0,',','.') }}
                </h2>
            </div>

            <!-- Jumlah Pengajuan -->
            <div class="bg-white border border-emerald-100 rounded-3xl p-6 shadow-lg">
                <p class="text-sm text-slate-500">
                    Jumlah Pengajuan
                </p>

                <h2 class="mt-4 text-2xl font-bold text-emerald-600">
                    {{ $pinjaman->count() }}
                </h2>
            </div>

            <!-- Disetujui -->
            <div class="bg-white border border-green-100 rounded-3xl p-6 shadow-lg">
                <p class="text-sm text-slate-500">
                    Disetujui
                </p>

                <h2 class="mt-4 text-2xl font-bold text-green-600">
                    {{ $pinjaman->where('status','disetujui')->count() }}
                </h2>
            </div>

            <!-- Menunggu -->
            <div class="bg-white border border-lime-100 rounded-3xl p-6 shadow-lg">
                <p class="text-sm text-slate-500">
                    Menunggu
                </p>

                <h2 class="mt-4 text-2xl font-bold text-lime-600">
                    {{ $pinjaman->where('status','menunggu')->count() }}
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="pb-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white border border-emerald-100 rounded-3xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-700 to-green-700 p-6 text-white">
                <h2 class="text-xl font-bold">
                    Riwayat Pinjaman
                </h2>

                <p class="text-sm text-blue-100">
                    Riwayat seluruh pengajuan pinjaman Anda.
                </p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-emerald-50">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-left">
                                Jumlah
                            </th>

                            <th class="px-6 py-4 text-left">
                                Angsuran
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pinjaman as $item)
                        <tr class="border-t">
                            <td class="px-6 py-4">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-bold text-blue-600">
                                Rp {{ number_format($item->jumlah_pinjaman,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->lama_angsuran }} Bulan
                            </td>

                            <td class="px-6 py-4">
                            @if($item->status=='disetujui')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    Disetujui
                                </span>
                            @elseif($item->status=='menunggu')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    Menunggu
                                </span>
                            @elseif($item->status=='ditolak')
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                    Ditolak
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                    Lunas
                                </span>
                            @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-slate-500">
                                Belum ada riwayat pinjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</x-app-layout>