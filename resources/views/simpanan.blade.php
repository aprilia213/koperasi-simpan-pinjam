<x-app-layout>
<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Simpanan Saya</h1>
                <p class="text-slate-600 mt-2">Ringkasan total simpanan dan riwayat transaksi Anda.</p>
            </div>
            <div>
                <a href="{{ route('simpanan.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow transition">
                    + Setor Simpanan
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-100 border border-green-300 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Total Simpanan -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-md border border-emerald-100">
                <p class="text-slate-500 text-sm font-medium">Simpanan Pokok</p>
                <h3 class="text-2xl font-bold text-emerald-700 mt-2">Rp {{ number_format($simpananPokok, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md border border-emerald-100">
                <p class="text-slate-500 text-sm font-medium">Simpanan Wajib</p>
                <h3 class="text-2xl font-bold text-emerald-700 mt-2">Rp {{ number_format($simpananWajib, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md border border-emerald-100">
                <p class="text-slate-500 text-sm font-medium">Simpanan Sukarela</p>
                <h3 class="text-2xl font-bold text-emerald-700 mt-2">Rp {{ number_format($simpananSukarela, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-emerald-600 p-6 rounded-2xl shadow-md text-white">
                <p class="text-emerald-100 text-sm font-medium">Total Keseluruhan</p>
                <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-emerald-100">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-800">Riwayat Pengajuan Simpanan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">No</th>
                            <th class="px-6 py-4 text-left font-semibold">Jenis Simpanan</th>
                            <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-center font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $item)
                        <tr class="border-b hover:bg-emerald-50/50">
                            <td class="px-6 py-4 text-slate-700">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                Simpanan {{ ucfirst($item->jenis) }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-sm">
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'menunggu')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($item->status == 'diterima')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        Diterima
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400">
                                Belum ada riwayat transaksi simpanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>