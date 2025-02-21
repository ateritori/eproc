<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;

// 🔹 Halaman utama (Daftar Lelang)
Route::get('/', [LelangController::class, 'index'])->name('home');

// 🔹 Route untuk submit RFQ (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/rfq/{id}', [LelangController::class, 'submitRFQ'])->name('rfq.submit');
});

// 🔹 Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
});

// 🔹 Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// 🔹 Grup route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // 🔹 Dashboard User
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // 🔹 Profil Pengguna
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');

  // 🔹 Edit Akun User
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

// 🔹 Grup route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // 🔹 Edit Profil Vendor
    Route::get('/dashboard/ubah-vendor', [VendorController::class, 'edit'])->name('edit_vendor');
    Route::put('/dashboard/ubah-vendor', [VendorController::class, 'update'])->name('update_vendor');
});
});
