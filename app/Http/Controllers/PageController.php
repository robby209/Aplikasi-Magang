<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PklRegistration; 

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

    // Menampilkan halaman admin dengan daftar pendaftar (status 'pending')
    public function showAdmin()
    {
        $pklRegistrations = PklRegistration::with('user')
            ->where('status', 'pending')
            ->get();
        return view('admin.admin', ['pklRegistrations' => $pklRegistrations]);
    }

    // Menampilkan halaman daftar peserta (status 'accepted') + FILTER expired/active
    public function showDaftarPeserta(Request $request)
    {
        // Ambil parameter ?filter=expired atau ?filter=active (bisa juga ?filter=all)
        $filter = $request->query('filter');
        $today  = now()->startOfDay();

        // Query dasar: peserta 'accepted'
        $participantsQuery = PklRegistration::with('user')
            ->where('status', 'accepted');

        // Cek filter
        if ($filter === 'expired') {
            // end_date < hari ini
            $participantsQuery->whereDate('end_date', '<', $today);
        } elseif ($filter === 'active') {
            // end_date >= hari ini
            $participantsQuery->whereDate('end_date', '>=', $today);
        }
        // Ambil data dari query
        $participants = $participantsQuery->get();

        return view('admin.daftarPeserta', ['participants' => $participants]);
    }

    // Untuk menampilkan detail pendaftar admin
    public function showAdminDetail($id)
    {
        $registration = PklRegistration::with('user')->findOrFail($id);
        return view('admin.detail', ['registration' => $registration]);
    }
}
