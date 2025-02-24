<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\UserController;

// 🔹 Halaman utama (Landing Page)
Route::get('/', [LelangController::class, 'home'])->name('home');

// 🔹 Halaman Daftar Lelang
Route::get('/lelang', [LelangController::class, 'daftarLelang'])->name('lelang');

// 🔹 Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout'); // Optimalkan logout ke dalam AuthController
});

// 🔹 Grup route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    // 🔹 Dashboard Vendor
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // 🔹 Profil Pengguna
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');

    // 🔹 Edit Akun User
    Route::prefix('user')->group(function () {
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{id}/update', [UserController::class, 'update'])->name('user.update');
    });

    // 🔹 Edit Profil Vendor
    Route::prefix('dashboard/vendor')->group(function () {
        Route::get('edit/{id_vendor}', [UserController::class, 'editVendor'])->name('edit_vendor');
        Route::put('update/{id_vendor}', [UserController::class, 'updateVendor'])->name('update_vendor');
    });

    // 🔹 Submit Penawaran (hanya user login)
    Route::prefix('penawaran')->group(function () {
        Route::get('create/{id}', [UserController::class, 'create'])->name('penawaran.create');
        Route::post('{id}', [UserController::class, 'store'])->name('penawaran.store');
    });
});
