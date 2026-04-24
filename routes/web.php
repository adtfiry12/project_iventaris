<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

// Frontend
route::get('/', [
    FrontController::class,
    'index'
])->name('home');
// user
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-proses', [AuthController::class, 'register_proses'])->name('register_proses');

Route::middleware('auth')->group(function () {
    // logout User & Admin
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login_proses');
});

Route::middleware(['auth', 'cekrole:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Pengguna
    Route::resource('pengguna', PenggunaController::class);
});
