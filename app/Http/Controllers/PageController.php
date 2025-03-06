<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PklRegistration; // Pastikan model ini ada

class PageController extends Controller
{
    // Menampilkan halaman formulir PKL
    public function showForm()
    {
        return view('form');
    }

    // Menampilkan halaman progress PKL dengan data pendaftaran pengguna
    public function showProgress()
    {
        // Mengambil data pendaftaran untuk user yang sedang login
        $registrations = PklRegistration::where('user_id', Auth::id())->get();
        return view('progress', compact('registrations'));
    }

    // Menampilkan halaman profil pengguna
    public function showProfile()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        return view('user.profile.profile', ['user' => $user]);
    }

    // Menampilkan halaman admin dengan daftar pendaftar (yang statusnya pending)
    public function showAdmin()
    {
        // Mengambil data pendaftaran PKL dengan status 'pending' beserta data user terkait
        $pklRegistrations = PklRegistration::with('user')->where('status', 'pending')->get();
        return view('admin.admin', ['pklRegistrations' => $pklRegistrations]);
    }

    // Menampilkan halaman daftar peserta (yang statusnya accepted)
    public function showDaftarPeserta()
    {
        // Mengambil data pendaftaran PKL dengan status 'accepted'
        $participants = PklRegistration::with('user')->where('status', 'accepted')->get();
        return view('admin.daftarPeserta', ['participants' => $participants]);
    }

    // (Opsional) Method untuk menampilkan detail pendaftar admin
    public function showAdminDetail($id)
    {
        // Mengambil detail pendaftaran berdasarkan id
        $registration = PklRegistration::with('user')->findOrFail($id);
        return view('admin.detail', ['registration' => $registration]);
    }
}
