<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', [LelangController::class, 'index'])->name('home');

// Route untuk submit RFQ, hanya bisa diakses setelah login
Route::get('/rfq/{id}', [LelangController::class, 'submitRFQ'])->name('rfq.submit')->middleware('auth');

// Route untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// Grup route yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Dashboard dan profil
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profil'])->name('profile')->middleware('auth'); // Ganti profile dengan profil
    
    // Route untuk halaman pengeditan akun
    Route::get('/dashboard/ubah-akun', [UserController::class, 'editAccount'])->name('edit_account');
    Route::put('/dashboard/ubah-akun', [UserController::class, 'updateAccount'])->name('update_account');

    // Route untuk halaman pengeditan profil perusahaan
    Route::get('/dashboard/ubah-profil', [UserController::class, 'editProfile'])->name('edit_profile');
});