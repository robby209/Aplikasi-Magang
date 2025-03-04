<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PklRegistration;

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
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat data PKL Registration untuk user baru
        PklRegistration::create([
            'user_id' => $user->id,
            'telepon' => '' // Nomor telepon default kosong
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Memperbarui data profil user.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'telepon' => 'required|string|max:20', // Sesuaikan dengan nama field di database
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data user
        $user->name = $request->name;

        // Update data PKL Registration
        if ($user->pklRegistration) {
            $user->pklRegistration->telepon = $request->telepon;
            $user->pklRegistration->save();
        } else {
            // Jika belum ada data PKL Registration
            PklRegistration::create([
                'user_id' => $user->id,
                'telepon' => $request->telepon
            ]);
        }

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            
            // Simpan foto baru
            $path = $request->file('photo')->store('profile_images', 'public');
            $user->photo_path = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
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