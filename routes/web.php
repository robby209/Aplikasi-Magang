<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PklController;
use Illuminate\Support\Facades\Route;

// ==========================
// PUBLIC ROUTES (Tanpa Login)
// ==========================
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::get('/register', function () {
    return view('register.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// ===========================
// AUTHENTICATED ROUTES (Login)
// ===========================
Route::middleware(['auth'])->group(function () {

    // ---------- USER ROUTES ----------
    Route::get('/form', [PageController::class, 'showForm'])->name('form');
    Route::get('/progress', [PageController::class, 'showProgress'])->name('progress');
    Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');

    // EDIT PROFILE
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // LOGOUT - Harus diautentikasi
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ---------- PKL ROUTES ----------
    Route::post('/pkl-register', [PklController::class, 'register'])->name('pkl.register');
    Route::post('/pkl-registrations/{id}/status', [PklController::class, 'updateStatus'])->name('pkl.updateStatus');
});

// ==========================
// ADMIN ROUTES (Hanya Admin)
// ==========================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'showAdmin'])->name('admin');
    Route::get('/admin/daftar-peserta', [PageController::class, 'showDaftarPeserta'])->name('daftar-peserta');
    Route::get('/admin/detail/{id}', [PageController::class, 'showAdminDetail'])->name('admin.detail');
});
