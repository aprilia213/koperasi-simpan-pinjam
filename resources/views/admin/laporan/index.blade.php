<x-app-layout>

<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-4xl font-bold text-emerald-700">
                    Laporan Koperasi
                </h1>

                <p class="text-slate-600 mt-2">
                    Ringkasan data simpanan, pinjaman, pembayaran angsuran dan kondisi keuangan koperasi.
                </p>

            </div>

            <a href="{{ route('admin.laporan.pdf') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow-lg font-semibold transition">

                🖨 Cetak PDF

            </a>

        </div>





        {{-- ===================== --}}
        {{-- RINGKASAN STATISTIK --}}
        {{-- ===================== --}}

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            {{-- Anggota --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-4 border-blue-500">

                <p class="text-gray-500">
                    Jumlah Anggota
                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-3">

                    {{ $jumlahAnggota }}

                </h2>

                <p class="text-gray-400 mt-2">
                    Orang
                </p>

            </div>



            {{-- Simpanan --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-4 border-green-500">

                <p class="text-gray-500">
                    Total Simpanan
                </p>

                <h2 class="text-3xl font-bold text-green-600 mt-3">

                    Rp {{ number_format($jumlahSimpanan,0,',','.') }}

                </h2>

                <p class="text-gray-400 mt-2">
                    Disetujui
                </p>

            </div>



            {{-- Pinjaman --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-4 border-yellow-500">

                <p class="text-gray-500">
                    Total Pinjaman
                </p>

                <h2 class="text-3xl font-bold text-yellow-600 mt-3">

                    Rp {{ number_format($jumlahPinjaman,0,',','.') }}

                </h2>

                <p class="text-gray-400 mt-2">
                    Aktif & Lunas
                </p>

            </div>



            {{-- Pembayaran --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-4 border-purple-500">

                <p class="text-gray-500">
                    Total Pembayaran
                </p>

                <h2 class="text-3xl font-bold text-purple-600 mt-3">

                    Rp {{ number_format($jumlahPembayaran,0,',','.') }}

                </h2>

                <p class="text-gray-400 mt-2">
                    Angsuran Masuk
                </p>

            </div>

        </div>




        {{-- ===================================== --}}
        {{-- LAPORAN SIMPANAN --}}
        {{-- ===================================== --}}

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-emerald-100 mb-10">

            <div class="bg-emerald-600 px-6 py-4">

                <h2 class="text-xl text-white font-bold">
                    Laporan Simpanan
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-emerald-50">

<tr>

    <th class="px-6 py-4 text-left">
        No
    </th>

    <th class="px-6 py-4 text-left">
        Tanggal
    </th>

    <th class="px-6 py-4 text-left">
        Nama Anggota
    </th>

    <th class="px-6 py-4 text-center">
        Jenis Simpanan
    </th>

    <th class="px-6 py-4 text-right">
        Jumlah
    </th>

</tr>

</thead>

                    <tbody>

<tbody>

    @forelse($simpanan as $item)

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

        <td class="px-6 py-4 text-center">

            @php
                $jenis = [];

                if($item->simpanan_pokok > 0){
                    $jenis[] = 'Pokok';
                }

                if($item->simpanan_wajib > 0){
                    $jenis[] = 'Wajib';
                }

                if($item->simpanan_sukarela > 0){
                    $jenis[] = 'Sukarela';
                }
            @endphp

            <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                {{ implode(' + ', $jenis) }}
            </span>

        </td>

        <td class="px-6 py-4 text-right font-bold text-emerald-600">

            Rp {{ number_format(
                $item->simpanan_pokok +
                $item->simpanan_wajib +
                $item->simpanan_sukarela,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>

    @empty

    <tr>

        <td colspan="5" class="text-center py-8 text-slate-500">

            Belum ada data simpanan.

        </td>

    </tr>

    @endforelse

</tbody>

                    </tbody>

                </table>

            </div>

        </div>
                {{-- ===================================== --}}
        {{-- LAPORAN PINJAMAN --}}
        {{-- ===================================== --}}

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-blue-100 mb-10">

            <div class="bg-blue-600 px-6 py-4">

                <h2 class="text-xl font-bold text-white">
                    Laporan Pinjaman
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-blue-50">

                        <tr>

                            <th class="px-6 py-4 text-left">No</th>

                            <th class="px-6 py-4 text-left">Tanggal</th>

                            <th class="px-6 py-4 text-left">Nama Anggota</th>

                            <th class="px-6 py-4 text-left">Pinjaman</th>

                            <th class="px-6 py-4 text-left">Tenor</th>

                            <th class="px-6 py-4 text-left">Angsuran/Bulan</th>

                            <th class="px-6 py-4 text-center">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pinjaman as $item)

                        <tr class="border-b hover:bg-blue-50">

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

                                Rp {{ number_format($item->angsuran_per_bulan,0,',','.') }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($item->status=='menunggu')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        Menunggu
                                    </span>

                                @elseif($item->status=='disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        Disetujui
                                    </span>

                                @elseif($item->status=='lunas')

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                        Lunas
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-8 text-slate-500">

                                Belum ada data pinjaman.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
                {{-- ===================================== --}}
        {{-- LAPORAN PEMBAYARAN ANGSURAN --}}
        {{-- ===================================== --}}

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-purple-100 mb-10">

            <div class="bg-purple-600 px-6 py-4">

                <h2 class="text-xl font-bold text-white">
                    Laporan Pembayaran Angsuran
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-purple-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                No
                            </th>

                            <th class="px-6 py-4 text-left">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-left">
                                Nama Anggota
                            </th>

                            <th class="px-6 py-4 text-left">
                                Pinjaman
                            </th>

                            <th class="px-6 py-4 text-left">
                                Jumlah Bayar
                            </th>

                            <th class="px-6 py-4 text-center">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Bukti
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pembayaran as $item)

                        <tr class="border-b hover:bg-purple-50">

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

                                Rp {{ number_format($item->pinjaman->jumlah_pinjaman ?? 0,0,',','.') }}

                            </td>

                            <td class="px-6 py-4 text-green-600 font-bold">

                                Rp {{ number_format($item->jumlah,0,',','.') }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($item->status=='pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        Pending
                                    </span>

                                @elseif($item->status=='disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        Disetujui
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($item->bukti_pembayaran)

                                    <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}"
                                       target="_blank"
                                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition">

                                        Lihat Bukti

                                    </a>

                                @else

                                    <span class="text-gray-400">

                                        -

                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="py-8 text-center text-gray-500">

                                Belum ada data pembayaran angsuran.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
                {{-- ===================================== --}}
        {{-- REKAP KEUANGAN --}}
        {{-- ===================================== --}}

        <div class="bg-white rounded-3xl shadow-xl border border-emerald-100 overflow-hidden mb-10">

            <div class="bg-emerald-700 px-6 py-4">

                <h2 class="text-xl font-bold text-white">
                    Rekap Keuangan Koperasi
                </h2>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 p-8">

                {{-- Total Simpanan --}}
                <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200">

                    <p class="text-gray-500 text-sm">
                        Total Simpanan
                    </p>

                    <h3 class="text-2xl font-bold text-emerald-700 mt-2">
                        Rp {{ number_format($totalSimpanan,0,',','.') }}
                    </h3>

                </div>

                {{-- Total Pinjaman --}}
                <div class="bg-red-50 rounded-2xl p-6 border border-red-200">

                    <p class="text-gray-500 text-sm">
                        Total Pinjaman
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-2">
                        Rp {{ number_format($totalPinjaman,0,',','.') }}
                    </h3>

                </div>

                {{-- Total Pembayaran --}}
                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-200">

                    <p class="text-gray-500 text-sm">
                        Total Pembayaran
                    </p>

                    <h3 class="text-2xl font-bold text-blue-600 mt-2">
                        Rp {{ number_format($totalPembayaran,0,',','.') }}
                    </h3>

                </div>

                {{-- Saldo Kas --}}
                <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-300">

                    <p class="text-gray-500 text-sm">
                        Saldo Kas Koperasi
                    </p>

                    <h3 class="text-2xl font-bold text-yellow-700 mt-2">
                        Rp {{ number_format($saldoKas,0,',','.') }}
                    </h3>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="text-center text-sm text-gray-500 mt-12">

            © {{ date('Y') }} KSP Sejahtera • Sistem Informasi Koperasi Simpan Pinjam

        </div>

    </div>

</div>

</x-app-layout>