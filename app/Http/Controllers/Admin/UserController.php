<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Update the specified user's role.
     */
    public function updateRole(Request $request, User $user)
    {
        // Pastikan hanya admin yang bisa mengupdate role
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang dapat mengubah peran.');
        }

        $request->validate([
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        // Cegah admin mengubah perannya sendiri
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', "Peran pengguna {$user->name} berhasil diubah menjadi " . strtoupper($request->role) . "!");
    }
}
