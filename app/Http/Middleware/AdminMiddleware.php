<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Jika admin, lanjutkan request
        }

        // Jika bukan admin, redirect ke halaman lain (misal '/form') dengan pesan error
        return redirect('/form')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
    }
}
