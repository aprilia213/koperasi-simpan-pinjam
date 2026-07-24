<x-app-layout>
    <div class="bg-green-50 py-10 border-b border-green-100">
        <div class="max-w-7xl mx-auto px-6">
            <span class="inline-block px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full uppercase tracking-wider mb-3">Riwayat</span>
            <h2 class="text-3xl font-bold text-slate-800">Riwayat Transaksi Saya</h2>
        </div>
    </div>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 space-y-8">
            
            <!-- Riwayat Pembayaran -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xl font-bold text-slate-800 mb-6 border-b pb-4">Riwayat Pembayaran Angsuran</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-sm uppercase"><th class="pb-4">Tanggal</th><th class="pb-4">Nominal</th><th class="pb-4">Status</th><th class="pb-4">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pembayarans as $bayar)
                                <tr>
                                    <td class="py-4 text-slate-700">{{ $bayar->created_at->format('d M Y') }}</td>
                                    <td class="py-4 font-semibold text-slate-800">Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td class="py-4"><span class="px-3 py-1 rounded-full text-xs font-bold {{ $bayar->status == 'disetujui' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($bayar->status) }}</span></td>
                                    <td class="py-4">
                                        @if($bayar->bukti_pembayaran)
                                            <button onclick="showBukti('{{ asset('storage/'.$bayar->bukti_pembayaran) }}')" class="text-green-600 hover:text-green-800 font-bold text-sm underline">Lihat Bukti</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-4 text-center text-slate-500">Belum ada riwayat pembayaran.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Pengajuan Pinjaman -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xl font-bold text-slate-800 mb-6 border-b pb-4">Riwayat Pengajuan Pinjaman</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-sm uppercase"><th class="pb-4">Tanggal</th><th class="pb-4">Jumlah Pinjaman</th><th class="pb-4">Status</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pinjamans as $pinjaman)
                                <tr>
                                    <td class="py-4 text-slate-700">{{ $pinjaman->created_at->format('d M Y') }}</td>
                                    <td class="py-4 font-semibold text-slate-800">Rp{{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                                    <td class="py-4"><span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">{{ ucfirst($pinjaman->status) }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="py-4 text-center text-slate-500">Belum ada riwayat pengajuan pinjaman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="buktiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4 z-50" onclick="this.classList.add('hidden')">
        <div class="bg-white p-2 rounded-xl max-w-lg w-full cursor-default" onclick="event.stopPropagation()">
            <img id="buktiImage" src="" alt="Bukti" class="w-full rounded-lg">
            <button onclick="document.getElementById('buktiModal').classList.add('hidden')" class="w-full mt-3 text-sm text-slate-500 hover:text-red-500">Tutup</button>
        </div>
    </div>

    <script>
        function showBukti(url) {
            document.getElementById('buktiImage').src = url;
            document.getElementById('buktiModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>