<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>

        @page{
            margin:20px;
        }

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
            color:#222;
        }

        h1{
            margin:0;
            text-align:center;
            font-size:22px;
        }

        h2{
            margin:2px 0 20px;
            text-align:center;
            font-size:16px;
            font-weight:normal;
        }

        h3{
            margin-top:25px;
            margin-bottom:8px;
            background:#198754;
            color:white;
            padding:6px;
            font-size:13px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:18px;
        }

        th{
            background:#198754;
            color:white;
            border:1px solid #000;
            padding:6px;
        }

        td{
            border:1px solid #000;
            padding:5px;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .summary td{
            border:1px solid #999;
            padding:8px;
        }

    </style>

</head>

<body>

<h1>KSP SEJAHTERA</h1>
<h2>Laporan Koperasi Simpan Pinjam</h2>

<p>
    Tanggal Cetak :
    {{ now()->format('d-m-Y H:i') }}
</p>

<h3>Ringkasan Statistik</h3>

<table class="summary">

<tr>
    <td>Jumlah Anggota</td>
    <td>{{ $jumlahAnggota }}</td>
</tr>

<tr>
    <td>Total Simpanan</td>
    <td>
        Rp {{ number_format($jumlahSimpanan,0,',','.') }}
    </td>
</tr>

<tr>
    <td>Total Pinjaman</td>
    <td>
        Rp {{ number_format($jumlahPinjaman,0,',','.') }}
    </td>
</tr>

<tr>
    <td>Total Pembayaran Angsuran</td>
    <td>
        Rp {{ number_format($jumlahPembayaran,0,',','.') }}
    </td>
</tr>

<tr>
    <td>Saldo Kas</td>
    <td>
        Rp {{ number_format($saldoKas,0,',','.') }}
    </td>
</tr>

</table>



<h3>Laporan Simpanan</h3>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($simpanan as $item)

<tr>

<td class="text-center">
{{ $loop->iteration }}
</td>

<td>
{{ $item->user->name }}
</td>

<td>
{{ $item->created_at->format('d-m-Y') }}
</td>

<td class="text-right">
Rp {{ number_format($item->jumlah,0,',','.') }}
</td>

<td class="text-center">
{{ ucfirst($item->status) }}
</td>

</tr>

@endforeach

</tbody>

</table>



<h3>Laporan Pinjaman</h3>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Tenor</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($pinjaman as $item)

<tr>

<td class="text-center">
{{ $loop->iteration }}
</td>

<td>
{{ $item->user->name }}
</td>

<td>
{{ $item->created_at->format('d-m-Y') }}
</td>

<td class="text-right">
Rp {{ number_format($item->jumlah_pinjaman,0,',','.') }}
</td>

<td class="text-center">
{{ $item->lama_angsuran }} Bulan
</td>

<td class="text-center">
{{ ucfirst($item->status) }}
</td>

</tr>

@endforeach

</tbody>

</table>



<h3>Laporan Pembayaran Angsuran</h3>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($pembayaran as $item)

<tr>

<td class="text-center">
{{ $loop->iteration }}
</td>

<td>
{{ $item->user->name }}
</td>

<td>
{{ $item->created_at->format('d-m-Y') }}
</td>

<td class="text-right">
Rp {{ number_format($item->jumlah,0,',','.') }}
</td>

<td class="text-center">
{{ ucfirst($item->status) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>