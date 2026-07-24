<x-app-layout>
    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-6 pt-28">

            {{-- FORM PEMBAYARAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">

                <h3 class="text-2xl font-bold text-slate-800 mb-6">
                    Pembayaran Angsuran
                </h3>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-5">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-5">
                        <ul class="list-disc ml-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formPembayaran"
                    action="{{ route('transaksi.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mb-5">
                        <label class="block font-semibold mb-2">
                            Pilih Pinjaman
                        </label>

                        <select
                            id="pinjamanSelect"
                            name="pinjaman_id"
                            onchange="updateNominal()"
                            class="w-full border rounded-lg p-3"
                            required>

                            <option value="">-- Pilih Pinjaman --</option>

                            @foreach($pinjamans as $p)

                                <option
                                    value="{{ $p->id }}"
                                    data-angsuran="{{ $p->angsuran_per_bulan }}">

                                    Pinjaman :
                                    Rp{{ number_format($p->jumlah_pinjaman,0,',','.') }}

                                    |

                                    Angsuran :
                                    Rp{{ number_format($p->angsuran_per_bulan,0,',','.') }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-5">

                        <label class="block font-semibold mb-2">
                            Jumlah Bayar
                        </label>

                        <input
                            type="text"
                            id="jumlahBayarDisplay"
                            class="w-full border rounded-lg p-3 bg-gray-100"
                            readonly>

                        <input
                            type="hidden"
                            id="jumlahBayarInput"
                            name="jumlah_bayar">

                    </div>

                    <div class="mb-5">

                        <label class="block font-semibold mb-2">
                            Upload Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            id="bukti"
                            name="bukti_pembayaran"
                            class="w-full border rounded-lg p-3"
                            accept="image/*"
                            required>

                    </div>

                    <div class="mb-5">

                        <img
                            id="preview"
                            class="hidden w-72 rounded-lg border">

                    </div>

                    <button
                        id="submitBtn"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg w-full">

                        Kirim Bukti Pembayaran

                    </button>

                </form>

            </div>

            {{-- RIWAYAT PEMBAYARAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Riwayat Pembayaran
                </h3>

                @if($pembayarans->count())

                <div class="overflow-x-auto">

                    <table class="w-full border">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border p-3">Tanggal</th>
                                <th class="border p-3">Pinjaman</th>
                                <th class="border p-3">Jumlah</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Bukti</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($pembayarans as $item)

                        <tr>

                            <td class="border p-3">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <td class="border p-3">
                                Rp {{ number_format($item->pinjaman->jumlah_pinjaman,0,',','.') }}
                            </td>

                            <td class="border p-3">
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </td>

                            <td class="border p-3">

                                @if($item->status=='pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                        Pending
                                    </span>

                                @elseif($item->status=='disetujui')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                        Disetujui
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td class="border p-3">

                                <a
                                    href="{{ asset('storage/'.$item->bukti_pembayaran) }}"
                                    target="_blank"
                                    class="text-blue-600 underline">

                                    Lihat Bukti

                                </a>

                            </td>

                        </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                    <div class="text-center text-gray-500 py-8">
                        Belum ada pembayaran angsuran.
                    </div>

                @endif

            </div>

        </div>
    </div>

<script>

function updateNominal(){

    let select=document.getElementById('pinjamanSelect');

    let option=select.options[select.selectedIndex];

    let nominal=option.getAttribute('data-angsuran');

    if(nominal){

        document.getElementById('jumlahBayarDisplay').value=
        new Intl.NumberFormat('id-ID',{
            style:'currency',
            currency:'IDR'
        }).format(nominal);

        document.getElementById('jumlahBayarInput').value=nominal;

    }else{

        document.getElementById('jumlahBayarDisplay').value='';

        document.getElementById('jumlahBayarInput').value='';

    }

}

document.getElementById('bukti').addEventListener('change',function(e){

    let file=e.target.files[0];

    if(file){

        let reader=new FileReader();

        reader.onload=function(event){

            let img=document.getElementById('preview');

            img.src=event.target.result;

            img.classList.remove('hidden');

        }

        reader.readAsDataURL(file);

    }

});

document.getElementById('formPembayaran').addEventListener('submit',function(){

    let btn=document.getElementById('submitBtn');

    btn.disabled=true;

    btn.innerHTML='Mengirim...';

});

</script>

</x-app-layout>