<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial menggunakan Auth::attempt()
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika berhasil login, cek role user
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika admin, arahkan ke route 'admin'
                return redirect()->route('admin');
            } else {
                // Jika bukan admin, arahkan ke route 'form'
                return redirect()->route('form');
            }
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Menampilkan halaman registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran pengguna.
     * Hanya menggunakan name, email, dan password (dengan konfirmasi).
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data pengguna baru ke database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
