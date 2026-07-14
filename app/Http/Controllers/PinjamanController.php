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

        if ($simpanan &&
            $simpanan->simpanan_pokok > 0 &&
            $simpanan->simpanan_wajib > 0
        ) {
            $anggotaAktif = true;
        }
        return view('pinjaman-create', compact('anggotaAktif'));
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

        // Menentukan bunga
        switch ($request->lama_angsuran) {
            case 6:
                $bunga = 5;
                break;
            case 12:
                $bunga = 8;
                break;
            case 24:
                $bunga = 10;
                break;
            case 36:
                $bunga = 12;
                break;
            default:
                $bunga = 10;
        }

        $jumlah = $request->jumlah_pinjaman;
        $nilaiBunga = ($jumlah * $bunga) / 100;
        $total = $jumlah + $nilaiBunga;
        $angsuran = $total / $request->lama_angsuran;
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