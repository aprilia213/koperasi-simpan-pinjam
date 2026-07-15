<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AdminPinjamanController extends Controller {
    public function index() {
        $pinjaman = Pinjaman::with('user')->latest()->get();
        return view('admin.pinjamanadmin', compact('pinjaman'));
    }

    public function update(Request $request, $id) {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Status pinjaman berhasil diperbarui.'
        );
    }
}