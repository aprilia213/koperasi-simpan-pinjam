<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\PembayaranPinjaman;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Data Simpanan
        $simpanans = Simpanan::where('user_id', $user->id)->get();
        
        // Data Pengajuan Pinjaman
        $pinjamans = Pinjaman::where('user_id', $user->id)->latest()->get();

        // Data Pembayaran (Mengambil pembayaran milik pinjaman user)
        $pembayarans = PembayaranPinjaman::whereHas('pinjaman', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->get();

        return view('riwayat.index', compact('simpanans', 'pinjamans', 'pembayarans'));
    }
}