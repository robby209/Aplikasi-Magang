<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PklController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/daftar-peserta', [\App\Http\Controllers\PageController::class, 'showDaftarPeserta'])->name('daftar-peserta');

// Route untuk memproses pendaftaran PKL
Route::post('/pkl-register', [PklController::class, 'register'])->name('pkl.register');

// Route untuk update status pendaftaran (Terima/Tolak)
Route::post('/pkl-registrations/{id}/status', [PklController::class, 'updateStatus'])
    ->name('pkl.updateStatus');

// Route untuk menampilkan detail pendaftar (halaman detail admin)
Route::get('/admin/detail/{id}', [PageController::class, 'showAdminDetail'])->name('admin.detail');

// Route untuk halaman utama (/) -> Redirect ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Route untuk halaman admin (GET)
Route::get('/admin', [PageController::class, 'showAdmin'])->name('admin');

// Route untuk halaman login (GET)
Route::get('/login', function () {
    return view('login.login');
})->name('login');

// Route untuk halaman register (GET)
Route::get('/register', function () {
    return view('register.register');
})->name('register');

// Route untuk memproses pendaftaran pengguna (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route untuk memproses login pengguna (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk halaman formulir PKL (GET)
Route::get('/form', [PageController::class, 'showForm'])->name('form');

// Route untuk halaman progress PKL (GET)
Route::get('/progress', [PageController::class, 'showProgress'])->name('progress');

// Route untuk halaman profil pengguna (GET)
Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');

// Route untuk logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// (Opsional) Tambahkan route lain sesuai kebutuhan, misalnya halaman form admin:
// Route::get('/admin/form', function () {
//     return view('admin.adminForm');
// })->name('admin.form');
