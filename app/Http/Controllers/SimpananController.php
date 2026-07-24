<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Simpanan;
use App\Models\TransaksiSimpanan;

class SimpananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $simpanan = Simpanan::where('user_id', $user->id)->first();

        $simpananPokok = $simpanan?->simpanan_pokok ?? 0;
        $simpananWajib = $simpanan?->simpanan_wajib ?? 0;
        $simpananSukarela = $simpanan?->simpanan_sukarela ?? 0;

        $totalSimpanan =
            $simpananPokok +
            $simpananWajib +
            $simpananSukarela;

        $riwayat = TransaksiSimpanan::where('user_id', $user->id)
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

    public function create()
    {
        $simpanan = Simpanan::where('user_id', Auth::id())->first();

        // Cek apakah simpanan pokok sudah pernah dibayar
        $sudahBayarPokok = false;

        if ($simpanan && $simpanan->simpanan_pokok >= 100000) {
            $sudahBayarPokok = true;
        }

        // Cek apakah simpanan wajib bulan ini sudah dibayar
        $sudahBayarWajibBulanIni = TransaksiSimpanan::where('user_id', Auth::id())
            ->where('jenis', 'wajib')
            ->whereIn('status', ['menunggu', 'diterima'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->exists();

        return view('simpanan-create', compact(
            'sudahBayarPokok',
            'sudahBayarWajibBulanIni'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric|min:1000',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN POKOK
        |--------------------------------------------------------------------------
        */

        if ($request->jenis == 'pokok') {

            $simpanan = Simpanan::where('user_id', Auth::id())->first();

            if ($simpanan && $simpanan->simpanan_pokok >= 100000) {

                return back()
                    ->withInput()
                    ->with('error', 'Simpanan Pokok hanya dapat dibayarkan satu kali.');
            }

            if ($request->jumlah != 100000) {

                return back()
                    ->withInput()
                    ->with('error', 'Nominal Simpanan Pokok harus Rp100.000.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN WAJIB
        |--------------------------------------------------------------------------
        */

        if ($request->jenis == 'wajib') {

            $cekWajib = TransaksiSimpanan::where('user_id', Auth::id())
                ->where('jenis', 'wajib')
                ->whereIn('status', ['menunggu', 'diterima'])
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->exists();

            if ($cekWajib) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Simpanan wajib bulan ini sudah dibayarkan. Silakan membayar kembali bulan depan.'
                    );
            }

            if ($request->jumlah != 50000) {

                return back()
                    ->withInput()
                    ->with('error', 'Nominal Simpanan Wajib harus Rp50.000.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Bukti
        |--------------------------------------------------------------------------
        */

        $path = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        /*
        |--------------------------------------------------------------------------
        | Simpan Transaksi
        |--------------------------------------------------------------------------
        */

        TransaksiSimpanan::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'bukti_pembayaran' => $path,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('simpanan')
            ->with('success', 'Pengajuan simpanan berhasil dikirim dan menunggu verifikasi admin.');
    }
}