<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PklController;
use Illuminate\Support\Facades\Route;

// --- Public Routes (tidak memerlukan autentikasi) --- //
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

// --- Routes yang memerlukan autentikasi --- //
Route::middleware(['auth'])->group(function () {

    // Halaman untuk user biasa
    Route::get('/form', [PageController::class, 'showForm'])->name('form');
    Route::get('/progress', [PageController::class, 'showProgress'])->name('progress');
    Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk pendaftaran PKL dan update status
    Route::post('/pkl-register', [PklController::class, 'register'])->name('pkl.register');
    Route::post('/pkl-registrations/{id}/status', [PklController::class, 'updateStatus'])->name('pkl.updateStatus');

    // --- Routes Admin (hanya dapat diakses oleh user dengan role admin) --- //
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [PageController::class, 'showAdmin'])->name('admin');
        Route::get('/admin/daftar-peserta', [PageController::class, 'showDaftarPeserta'])->name('daftar-peserta');
        Route::get('/admin/detail/{id}', [PageController::class, 'showAdminDetail'])->name('admin.detail');
    });
});
