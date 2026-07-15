<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pinjaman;
use App\Models\Simpanan;

class PinjamanController extends Controller {
    public function index()
    {
        $userId = Auth::id();
        $pinjaman = Pinjaman::where('user_id', $userId)
            ->latest()
            ->get();
        $simpanan = Simpanan::where('user_id', $userId)->first();
        $anggotaAktif = false;

        if ($simpanan &&
            $simpanan->simpanan_pokok > 0 &&
            $simpanan->simpanan_wajib > 0)
        {
            $anggotaAktif = true;
        }
        return view('pinjaman', compact(
            'pinjaman',
            'anggotaAktif'
        ));
    }

    public function create(){
        $userId = Auth::id();
        $simpanan = Simpanan::where('user_id', $userId)->first();
        $anggotaAktif = false;
        $totalSimpanan = 0;

        if ($simpanan) {
            if(
                $simpanan->simpanan_pokok > 0 &&
                $simpanan->simpanan_wajib > 0
            ){
                $anggotaAktif = true;
            }

            $totalSimpanan =
            $simpanan->simpanan_pokok +
            $simpanan->simpanan_wajib +
            $simpanan->simpanan_sukarela;
        }
        return view('pinjaman-create', compact(
            'anggotaAktif',
            'totalSimpanan'
        ));
    }
    
    public function store(Request $request) {
        $request->validate([
            'jumlah_pinjaman' => 'required|numeric|min:100000',
            'lama_angsuran' => 'required|integer|in:6,12,24,36'
        ]);
        $userId = Auth::id();   
        $simpanan = Simpanan::where('user_id', $userId)->first();

        if (!$simpanan ||
            $simpanan->simpanan_pokok <= 0 ||
            $simpanan->simpanan_wajib <= 0
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Anda bukan anggota aktif. Silakan tunggu konfirmasi Simpanan Pokok dan Simpanan Wajib.'
                );
        }

        // hitung total simpanan

        $totalSimpanan =
            $simpanan->simpanan_pokok +
            $simpanan->simpanan_wajib +
            $simpanan->simpanan_sukarela;

        $jumlah = $request->jumlah_pinjaman;

        // aturan minimal simpanan
        if($jumlah <= 5000000){
            $minimalSimpanan = 500000;
        }else{
            $minimalSimpanan = 1000000;
        }

        if($totalSimpanan < $minimalSimpanan){
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pengajuan ditolak. Total simpanan minimal Rp ' .
                    number_format($minimalSimpanan,0,',','.')
                );
        }

        // bunga tetap 2% per bulan
        $bunga = 2;
        $lama = $request->lama_angsuran;
        $nilaiBunga =
            $jumlah *
            ($bunga / 100) *
            $lama;
        $total =
            $jumlah + $nilaiBunga;
        $angsuran =
            $total / $lama;
        Pinjaman::create([
            'user_id' => $userId,
            'jumlah_pinjaman' => $jumlah,
            'lama_angsuran' => $request->lama_angsuran,
            'bunga' => $bunga,
            'total_pinjaman' => $total,
            'angsuran_per_bulan' => round($angsuran),
            'status' => 'menunggu'
        ]);

        return redirect()
            ->route('pinjaman')
            ->with('success',
            'Pengajuan pinjaman berhasil dikirim');
        }

    public function update(Request $request, $id) {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'status'=>$request->status
        ]);
        return back()
            ->with('success',
            'Status pinjaman berhasil diperbarui');
    }

    public function destroy($id) {
        Pinjaman::findOrFail($id)->delete();
        return back();
    }
}