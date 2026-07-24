<x-app-layout>

<div class="pt-24 min-h-screen bg-gradient-to-br from-white via-emerald-50 to-green-100">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-emerald-700">
                Kelola Anggota
            </h1>

            <p class="text-slate-600 mt-2">
                Daftar seluruh anggota koperasi beserta status keanggotaannya.
            </p>
        </div>

    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif


    <!-- Statistik -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-emerald-500">

            <p class="text-gray-500">
                Total Anggota
            </p>

            <h2 class="text-3xl font-bold text-emerald-600 mt-2">
                {{ $anggota->count() }}
            </h2>

        </div>


        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-500">

            <p class="text-gray-500">
                Anggota Aktif
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $anggota->where('status_keanggotaan','Aktif')->count() }}
            </h2>

        </div>


        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-500">

            <p class="text-gray-500">
                Belum Aktif
            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">
                {{ $anggota->where('status_keanggotaan','Belum Aktif')->count() }}
            </h2>

        </div>

    </div>



    <!-- Tabel -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-emerald-600 px-6 py-4">

            <h2 class="text-xl font-bold text-white">
                Data Anggota
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-emerald-50">

                    <tr>

                        <th class="px-6 py-4 text-left">No</th>

                        <th class="px-6 py-4 text-left">Nama</th>

                        <th class="px-6 py-4 text-left">Email</th>

                        <th class="px-6 py-4 text-center">Verifikasi Email</th>

                        <th class="px-6 py-4 text-right">Simpanan Pokok</th>

                        <th class="px-6 py-4 text-right">Simpanan Wajib</th>

                        <th class="px-6 py-4 text-right">Simpanan Sukarela</th>

                        <th class="px-6 py-4 text-right">Total Simpanan</th>

                        <th class="px-6 py-4 text-center">Status Anggota</th>

                        <th class="px-6 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($anggota as $item)

                    <tr class="border-b hover:bg-emerald-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            {{ $item->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>

                        {{-- Verifikasi Email --}}
                        <td class="px-6 py-4 text-center">

                            @if($item->email_verified_at)

                                <span class="inline-flex items-center justify-center min-w-[140px] px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    ✓ Terverifikasi
                                </span>

                            @else

                                <span class="inline-flex items-center justify-center min-w-[140px] px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                    ✕ Belum
                                </span>

                            @endif

                        </td>

                        {{-- Simpanan --}}
                        <td class="px-6 py-4 text-right">
                            Rp {{ number_format($item->simpanan?->simpanan_pokok ?? 0,0,',','.') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            Rp {{ number_format($item->simpanan?->simpanan_wajib ?? 0,0,',','.') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            Rp {{ number_format($item->simpanan?->simpanan_sukarela ?? 0,0,',','.') }}
                        </td>

                        <td class="px-6 py-4 text-right font-bold text-emerald-700">
                            Rp {{ number_format($item->total_simpanan,0,',','.') }}
                        </td>

                        {{-- Status Anggota --}}
                        <td class="px-6 py-4 text-center">

                            @if($item->status_keanggotaan == 'Aktif')

                                <span class="inline-flex items-center justify-center min-w-[120px] px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    ✔ Aktif
                                </span>

                            @else

                                <span class="inline-flex items-center justify-center min-w-[120px] px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                    ✖ Belum Aktif
                                </span>

                            @endif

                        </td>

                        {{-- Tombol Hapus --}}
                        <td class="px-6 py-4 text-center">

                            <form action="{{ route('admin.anggota.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center py-8 text-gray-500">

                            Belum ada anggota.

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