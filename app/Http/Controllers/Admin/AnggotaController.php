<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::where('role', 'user')
            ->with('simpanan')
            ->latest()
            ->get()
            ->map(function ($user) {

                $pokok = $user->simpanan?->simpanan_pokok ?? 0;
                $wajib = $user->simpanan?->simpanan_wajib ?? 0;
                $sukarela = $user->simpanan?->simpanan_sukarela ?? 0;

                $user->total_simpanan =
                    $pokok +
                    $wajib +
                    $sukarela;

                $user->status_keanggotaan =
                    ($pokok >= 100000 && $wajib >= 50000)
                    ? 'Aktif'
                    : 'Belum Aktif';

                return $user;
            });

        return view('admin.anggota.index', compact('anggota'));
    }
    public function destroy(User $user)
{
    // Mencegah admin menghapus akun admin lain
    if ($user->role === 'admin') {
        return back()->with('error', 'Admin tidak dapat dihapus.');
    }

    $user->delete();

    return redirect()
        ->route('admin.anggota')
        ->with('success', 'Anggota berhasil dihapus.');
}
}