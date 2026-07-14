<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Simpanan;
use App\Models\TransaksiSimpanan;

class SimpananController extends Controller {
    public function index() {
        $user = Auth::user();
        $simpanan = Simpanan::where(
            'user_id',
            $user->id
        )->first();

        $simpananPokok = $simpanan?->simpanan_pokok ?? 0;
        $simpananWajib = $simpanan?->simpanan_wajib ?? 0;
        $simpananSukarela = $simpanan?->simpanan_sukarela ?? 0;

        $totalSimpanan =
            $simpananPokok +
            $simpananWajib +
            $simpananSukarela;

        $riwayat = TransaksiSimpanan::where(
            'user_id',
            $user->id
        )
        ->latest()
        ->get();

        return view('simpanan', compact(
            'simpananPokok',
            'simpananWajib',
            'simpananSukarela',
            'totalSimpanan',
            'riwayat'
        ));
    }

    public function create() {
        $simpanan = \App\Models\Simpanan::where('user_id', auth()->id())->first();
        $sudahBayarPokok = false;

        if ($simpanan && $simpanan->simpanan_pokok > 0) {
            $sudahBayarPokok = true;
        }
        return view('simpanan-create', compact('sudahBayarPokok'));
    }

    public function store(Request $request) {
        $request->validate([
            'jenis' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        // Cek apakah simpanan pokok sudah pernah dibayar
        if ($request->jenis == 'pokok') {
            $simpanan = Simpanan::where('user_id', Auth::id())->first();
            if ($simpanan && $simpanan->simpanan_pokok > 0) {
                return back()
                    ->withInput()
                    ->with('error', 'Simpanan Pokok hanya dapat dibayarkan satu kali.');
            }
        }

        // Simpan pengajuan
        TransaksiSimpanan::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu'
        ]);

        return redirect()
            ->route('simpanan')
            ->with(
                'success',
                'Pengajuan simpanan berhasil dikirim'
            );
    }
}