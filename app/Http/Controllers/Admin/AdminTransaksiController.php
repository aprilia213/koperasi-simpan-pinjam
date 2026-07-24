<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\TransaksiPinjaman;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    /**
     * Halaman verifikasi pembayaran
     */
    public function index()
    {
        $pembayaran = TransaksiPinjaman::with([
                'user',
                'pinjaman'
            ])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('pembayaran'));
    }

    /**
     * Terima pembayaran
     */
    public function terima($id)
    {
        $transaksi = TransaksiPinjaman::with('pinjaman')->findOrFail($id);

        $transaksi->update([
            'status' => 'disetujui'
        ]);

        $pinjaman = $transaksi->pinjaman;

        if ($pinjaman) {

            // Total pembayaran yang sudah disetujui
            $totalBayar = TransaksiPinjaman::where('pinjaman_id', $pinjaman->id)
                ->where('status', 'disetujui')
                ->sum('jumlah');

            // Jika sudah lunas
            if ($totalBayar >= $pinjaman->jumlah_pinjaman) {

                $pinjaman->update([
                    'status' => 'lunas'
                ]);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    /**
     * Tolak pembayaran
     */
    public function tolak($id)
    {
        $transaksi = TransaksiPinjaman::findOrFail($id);

        $transaksi->update([
            'status' => 'ditolak'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pembayaran berhasil ditolak.');
    }
}