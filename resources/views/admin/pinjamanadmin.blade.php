<x-app-layout>
<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-emerald-700">
                Kelola Pinjaman
            </h1>

            <p class="text-slate-600 mt-2">
                Daftar seluruh pengajuan pinjaman anggota koperasi.
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
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Nama Anggota</th>
                            <th class="px-6 py-4 text-left">Jumlah Pinjaman</th>
                            <th class="px-6 py-4 text-left">Lama Angsuran</th>
                            <th class="px-6 py-4 text-left">Total Pinjaman</th>
                            <th class="px-6 py-4 text-left">Angsuran/Bulan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($pinjaman as $item)

                        <tr class="border-b hover:bg-emerald-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $item->user->name }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($item->jumlah_pinjaman,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->lama_angsuran }} Bulan
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($item->total_pinjaman,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($item->angsuran_per_bulan,0,',','.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4 text-center">

                                @if($item->status == 'menunggu')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        Menunggu
                                    </span>

                                @elseif($item->status == 'disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        Disetujui
                                    </span>

                                @elseif($item->status == 'lunas')

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                        Lunas
                                    </span>

                                @elseif($item->status == 'ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4 text-center">

                                @if($item->status == 'menunggu')

                                    <div class="flex justify-center gap-2">

                                        <form action="{{ route('admin.pinjaman.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="status" value="disetujui">

                                            <button
                                                class="px-3 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white">
                                                Setujui
                                            </button>

                                        </form>

                                        <form action="{{ route('admin.pinjaman.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="status" value="ditolak">

                                            <button
                                                class="px-3 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white">
                                                Tolak
                                            </button>

                                        </form>

                                    </div>

                                @elseif($item->status == 'disetujui')

                                    <span class="font-semibold text-green-600">
                                        Sudah Disetujui
                                    </span>

                                @elseif($item->status == 'lunas')

                                    <span class="font-semibold text-blue-600">
                                        Sudah Lunas
                                    </span>

                                @elseif($item->status == 'ditolak')

                                    <span class="font-semibold text-red-600">
                                        Sudah Ditolak
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-8 text-slate-500">
                                Belum ada pengajuan pinjaman.
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