<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\TransaksiPinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTransaksiController extends Controller
{
    /**
     * Halaman pembayaran + riwayat pembayaran
     */
    public function index()
    {
        // Pinjaman user yang sudah disetujui
        $pinjamans = Pinjaman::where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        // Riwayat pembayaran user
        $pembayarans = TransaksiPinjaman::with('pinjaman')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.index', compact(
            'pinjamans',
            'pembayarans'
        ));
    }

    /**
     * Simpan pembayaran angsuran
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id'        => 'required|exists:pinjamans,id',
            'jumlah_bayar'       => 'required|numeric|min:1',
            'bukti_pembayaran'   => 'required|image|mimes:jpg,jpeg,png,jpeg|max:2048',
        ]);

        // Pastikan pinjaman milik user
        $pinjaman = Pinjaman::where('id', $request->pinjaman_id)
            ->where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->first();

        if (!$pinjaman) {
            return back()->withErrors([
                'pinjaman_id' => 'Pinjaman tidak ditemukan.'
            ]);
        }

        // Upload bukti
        $path = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        // Simpan transaksi
        TransaksiPinjaman::create([
            'user_id'            => Auth::id(),
            'pinjaman_id'        => $pinjaman->id,
            'jumlah'             => $request->jumlah_bayar,
            'bukti_pembayaran'   => $path,
            'status'             => 'pending',
        ]);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Pembayaran angsuran berhasil dikirim. Menunggu verifikasi admin.');
    }
}