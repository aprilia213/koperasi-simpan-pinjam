<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSimpanan;
use App\Models\Simpanan;

class AdminSimpananController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiSimpanan::with('user')
            ->latest()
            ->get();

        return view('admin.simpananadmin', compact('transaksi'));
    }


    public function terima($id) {
        $transaksi = TransaksiSimpanan::findOrFail($id);
        $transaksi->update([
            'status' => 'diterima'
        ]);

        // ambil data simpanan user
        $simpanan = Simpanan::firstOrCreate([
            'user_id' => $transaksi->user_id
        ]);

        // masukkan nominal sesuai jenis simpanan
        if($transaksi->jenis == 'pokok'){
            $simpanan->simpanan_pokok += $transaksi->jumlah;
        }elseif($transaksi->jenis == 'wajib'){
            $simpanan->simpanan_wajib += $transaksi->jumlah;
        }elseif($transaksi->jenis == 'sukarela'){
            $simpanan->simpanan_sukarela += $transaksi->jumlah;
        }

        $simpanan->save();
        
        return redirect()
            ->route('admin.simpananadmin')
            ->with('success', 'Simpanan berhasil diterima');
    }

    public function tolak($id) {
        $transaksi = TransaksiSimpanan::findOrFail($id);
        $transaksi->status = 'ditolak';
        $transaksi->save();

        return back()->with(
            'success',
            'Simpanan berhasil ditolak'
        );
    }

    public function update()
    {
        //
    }
}