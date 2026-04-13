<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\SewaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Anggota\RegisterController;
use App\Http\Controllers\Anggota\KamarController as UserKamarController;
use App\Http\Controllers\Anggota\RiwayatController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Tampilkan Form Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::prefix('admin')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::resource('kategori', KategoriController::class);


    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
    Route::put('/kamar/{kamar}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{kamar}', [KamarController::class, 'destroy'])->name('kamar.destroy');


    Route::get('/sewa', [SewaController::class, 'index'])->name('sewa');
    Route::get('/sewa/{sewa}', [SewaController::class, 'show'])->name('sewa.show');
    Route::put('/sewa/{sewa}', [SewaController::class, 'update'])->name('sewa.update');
    Route::delete('/sewa/{sewa}', [SewaController::class, 'destroy'])->name('sewa.destroy');
});


    

// Halaman customer kamar


Route::prefix('user')->middleware(['auth', 'role:0'])->group(function () {
    Route::get('/', [UserKamarController::class, 'showUser'])->name('customer.kamar');
    Route::post('/store', [UserKamarController::class, 'store'])->name('customer.store');
    Route::get('/settings', [UserKamarController::class, 'settings'])->name('customer.settings');
    Route::post('/settings', [UserKamarController::class, 'updateSettings'])->name('customer.settings.update');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::post('/riwayat/rating', [RiwayatController::class, 'updateRating'])->name('riwayat.rating');
});



    
