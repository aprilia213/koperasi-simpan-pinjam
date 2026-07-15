<x-app-layout>
<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-emerald-700">
                Kelola Simpanan
            </h1>

            <p class="text-slate-600 mt-2">
                Daftar seluruh transaksi simpanan anggota koperasi.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-100 border border-green-300 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-emerald-100">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-emerald-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama Anggota</th>
                            <th class="px-6 py-4 text-left">Jenis</th>
                            <th class="px-6 py-4 text-left">Jumlah</th>
                            <th class="px-6 py-4 text-left">Bukti</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksi as $item)
                        <tr class="border-b hover:bg-emerald-50">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $item->user->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ ucfirst($item->jenis) }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($item->bukti_pembayaran)
                                    <button 
                                        onclick="openBukti('{{ asset('storage/'.$item->bukti_pembayaran) }}')"
                                        class="text-blue-600 hover:underline">
                                        Lihat Bukti
                                    </button>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'menunggu')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                        Menunggu
                                    </span>
                                @elseif($item->status == 'diterima')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                        Diterima
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'menunggu')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.simpanan.terima', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="px-3 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
                                            Terima
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.simpanan.tolak', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="px-3 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                                @elseif($item->status == 'diterima')
                                <span class="text-green-600 font-semibold">
                                    Sudah Diterima
                                </span>
                                @else
                                <span class="text-red-600 font-semibold">
                                    Ditolak
                                </span>
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-slate-500">
                                Belum ada transaksi simpanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bukti Pembayaran -->
<div id="modalBukti" class="fixed inset-0 hidden bg-black/60 z-50 items-center justify-center">
    <div class="relative bg-white rounded-2xl p-5 max-w-3xl">
        <!-- Tombol X -->
        <button onclick="closeBukti()"
                class="absolute top-3 right-3 bg-red-500 text-white 
                rounded-full w-10 h-10 text-xl">
            ×
        </button>
        <!-- Gambar -->
        <img id="gambarBukti"
             src=""
             class="max-h-[80vh] rounded-xl">
    </div>
</div>

<script>
function openBukti(url) {
    document.getElementById('gambarBukti').src = url;

    let modal = document.getElementById('modalBukti');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}


function closeBukti() {
    let modal = document.getElementById('modalBukti');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    document.getElementById('gambarBukti').src = '';
}
</script>
</x-app-layout>