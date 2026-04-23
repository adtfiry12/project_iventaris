<?php

use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// pengguna
Route::get('/pengguna', [
    PenggunaController::class,
    'index'
])->name('pengguna.index');
Route::get('/pengguna/create', [
    PenggunaController::class,
    'create'
])->name('pengguna.create');
Route::post('/pengguna/store', [
    PenggunaController::class,
    'store'
])->name('pengguna.store');
Route::get('pengguna/edit/{id}', [
    PenggunaController::class,
    'edit'
])->name('pengguna.edit');
Route::get('/pengguna/delete/{id}', [
    PenggunaController::class,
    'destroy'
])->name('pengguna.destroy');
