<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Simpanan;
use App\Models\Pinjaman;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();
        $simpanan = Simpanan::where('user_id', $user->id)->first();

        $simpananPokok = $simpanan?->simpanan_pokok ?? 0;
        $simpananWajib = $simpanan?->simpanan_wajib ?? 0;
        $simpananSukarela = $simpanan?->simpanan_sukarela ?? 0;

        $totalSimpanan =
            $simpananPokok +
            $simpananWajib +
            $simpananSukarela;

        $totalPinjaman = Pinjaman::where('user_id',$user->id)
            ->sum('jumlah_pinjaman');

        return view('dashboard', compact(
            'user',
            'simpananPokok',
            'simpananWajib',
            'simpananSukarela',
            'totalSimpanan',
            'totalPinjaman'
        ));
    }
}