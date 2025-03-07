<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PklController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

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
// ==========================
Route::middleware(['auth'])->group(function () {

    // Halaman form untuk user
    Route::get('/form', [PageController::class, 'showForm'])->name('form');

    // Halaman progress (hanya bisa diakses jika login)
    Route::get('/progress', [RiwayatController::class, 'showProgress'])->name('progress');

    // Halaman profile
    Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');
    
    // Edit/Update profile
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // PKL Routes
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
