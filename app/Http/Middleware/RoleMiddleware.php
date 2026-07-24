<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        // AMBIL ROLE USER DAN UBAH KE HURUF KECIL
        $userRole = strtolower(auth()->user()->role);
        
        // UBAH SEMUA ROLE YANG DIIZINKAN KE HURUF KECIL
        $allowedRoles = array_map('strtolower', $roles);

        // CEK APAKAH ROLE USER TERMASUK DALAM ARRAY YANG DIIZINKAN
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}