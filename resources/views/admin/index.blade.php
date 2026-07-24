<x-app-layout>
    <div class="max-w-7xl mx-auto pt-28 pb-10 sm:px-6 lg:px-8">

        <div class="mb-8 border-l-4 border-emerald-600 pl-4">
            <h2 class="text-2xl font-bold text-slate-800">
                Verifikasi Pembayaran Anggota
            </h2>
            <p class="text-slate-500 text-sm">
                Kelola dan verifikasi pembayaran angsuran anggota koperasi.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-700 p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow border overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-emerald-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Anggota</th>
                        <th class="px-6 py-4 text-left">Pinjaman</th>
                        <th class="px-6 py-4 text-left">Jumlah Bayar</th>
                        <th class="px-6 py-4 text-left">Bukti</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($pembayaran as $item)

                        <tr>

                            <td class="px-6 py-4">
                                <div class="font-semibold">
                                    {{ $item->user->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    User ID : {{ $item->user_id }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($item->pinjaman->jumlah_pinjaman,0,',','.') }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                <a
                                    href="{{ asset('storage/'.$item->bukti_pembayaran) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">

                                    Lihat Bukti

                                </a>
                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($item->status=='pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                        Pending
                                    </span>

                                @elseif($item->status=='disetujui')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                        Disetujui
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                @if($item->status=='pending')

                                    <div class="flex justify-center gap-2">

                                        <form method="POST"
                                            action="{{ route('admin.transaksi.terima',$item->id) }}">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

                                                Terima

                                            </button>

                                        </form>

                                        <form method="POST"
                                            action="{{ route('admin.transaksi.tolak',$item->id) }}">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                                Tolak

                                            </button>

                                        </form>

                                    </div>

                                @else

                                    <div class="text-center text-gray-500">
                                        Selesai
                                    </div>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-8 text-gray-500">

                                Tidak ada pembayaran yang menunggu verifikasi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</x-app-layout>