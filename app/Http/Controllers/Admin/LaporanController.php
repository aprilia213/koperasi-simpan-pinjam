<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\TransaksiPinjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ringkasan Statistik
        |--------------------------------------------------------------------------
        */

        $jumlahAnggota = User::where('role', 'user')->count();

        // Total Simpanan
        $jumlahSimpanan =
            Simpanan::sum('simpanan_pokok') +
            Simpanan::sum('simpanan_wajib') +
            Simpanan::sum('simpanan_sukarela');

        // Total Pinjaman
        $jumlahPinjaman = Pinjaman::whereIn('status', ['disetujui', 'lunas'])
            ->sum('jumlah_pinjaman');

        // Total Pembayaran
        $jumlahPembayaran = TransaksiPinjaman::where('status', 'disetujui')
            ->sum('jumlah');


        /*
        |--------------------------------------------------------------------------
        | Data Tabel
        |--------------------------------------------------------------------------
        */

        $simpanan = Simpanan::with('user')
            ->latest()
            ->get();

        $pinjaman = Pinjaman::with('user')
            ->latest()
            ->get();

        $pembayaran = TransaksiPinjaman::with([
            'user',
            'pinjaman'
        ])
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Rekap Keuangan
        |--------------------------------------------------------------------------
        */

        $totalSimpanan =
            $simpanan->sum('simpanan_pokok') +
            $simpanan->sum('simpanan_wajib') +
            $simpanan->sum('simpanan_sukarela');

        $totalPinjaman = $pinjaman
            ->whereIn('status', ['disetujui', 'lunas'])
            ->sum('jumlah_pinjaman');

        $totalPembayaran = $pembayaran
            ->where('status', 'disetujui')
            ->sum('jumlah');

        $saldoKas = $totalSimpanan + $totalPembayaran - $totalPinjaman;


        return view('admin.laporan.index', compact(
            'jumlahAnggota',
            'jumlahSimpanan',
            'jumlahPinjaman',
            'jumlahPembayaran',

            'simpanan',
            'pinjaman',
            'pembayaran',

            'totalSimpanan',
            'totalPinjaman',
            'totalPembayaran',
            'saldoKas'
        ));
    }


    /**
     * Cetak PDF
     */
    public function pdf()
    {
        $jumlahAnggota = User::where('role', 'user')->count();

        $jumlahSimpanan =
            Simpanan::sum('simpanan_pokok') +
            Simpanan::sum('simpanan_wajib') +
            Simpanan::sum('simpanan_sukarela');

        $jumlahPinjaman = Pinjaman::whereIn('status', ['disetujui', 'lunas'])
            ->sum('jumlah_pinjaman');

        $jumlahPembayaran = TransaksiPinjaman::where('status', 'disetujui')
            ->sum('jumlah');

        $simpanan = Simpanan::with('user')
            ->latest()
            ->get();

        $pinjaman = Pinjaman::with('user')
            ->latest()
            ->get();

        $pembayaran = TransaksiPinjaman::with([
            'user',
            'pinjaman'
        ])
            ->latest()
            ->get();

        $totalSimpanan =
            $simpanan->sum('simpanan_pokok') +
            $simpanan->sum('simpanan_wajib') +
            $simpanan->sum('simpanan_sukarela');

        $totalPinjaman = $pinjaman
            ->whereIn('status', ['disetujui', 'lunas'])
            ->sum('jumlah_pinjaman');

        $totalPembayaran = $pembayaran
            ->where('status', 'disetujui')
            ->sum('jumlah');

        $saldoKas = $totalSimpanan + $totalPembayaran - $totalPinjaman;

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'jumlahAnggota',
            'jumlahSimpanan',
            'jumlahPinjaman',
            'jumlahPembayaran',

            'simpanan',
            'pinjaman',
            'pembayaran',

            'totalSimpanan',
            'totalPinjaman',
            'totalPembayaran',
            'saldoKas'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-koperasi.pdf');
    }
}