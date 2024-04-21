<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PustakaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isGuest;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('register/inputRegister', [AuthController::class, 'inputRegister'])->name('register.inputRegister');

Route::middleware('isGuest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['isLogin', 'role:admin,pustakawan'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::prefix('perpustakaan')->group(function () {
            Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
            Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
            Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
            Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::delete('kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

            Route::get('buku', [BukuController::class, 'index'])->name('buku.index');
            Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
            Route::post('buku/store', [BukuController::class, 'store'])->name('buku.store');
            Route::get('buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
            Route::put('buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
            Route::delete('buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.delete');

            Route::get('peminjaman/admin', [PeminjamanController::class, 'admin'])->name('peminjaman.admin');
            Route::get('peminjaman-exportPdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.exportPdf');
        });
    });
});

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::prefix('dashboard/pengaturan')->group(function () {
            Route::get('user', [UserController::class, 'index'])->name('user.index');
            Route::get('user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('user/store', [UserController::class, 'store'])->name('user.store');
            Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        });
    });

    Route::middleware(['isLogin', 'role:pembaca'])->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::prefix('perpustakaan')->group(function () {
            Route::get('pustaka', [PustakaController::class, 'index'])->name('pustaka.index');
            Route::get('pustaka/{buku}', [PustakaController::class, 'show'])->name('pustaka.show');
            Route::get('koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
            Route::post('koleksi/store', [KoleksiController::class, 'store'])->name('koleksi.store');
            Route::delete('koleksi/destroy/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');
            Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
            Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
            Route::put('peminjaman/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');
            Route::patch('peminjaman/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');
            Route::get('ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
            Route::post('ulasan/store', [UlasanController::class, 'store'])->name('ulasan.store');
        });
    });
});