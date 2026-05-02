<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/about', function () {
    return Inertia::render('About', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('about');

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'approval') {
        return redirect()->route('approval.dashboard');
    } else {
        return redirect()->route('karyawan.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/kontak', [App\Http\Controllers\KontakController::class, 'index'])->name('kontak');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::get('/barang', [AdminController::class, 'barang'])->name('barang.index');
    Route::post('/barang', [AdminController::class, 'storeBarang'])->name('barang.store');
    Route::put('/barang/{id}', [AdminController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'destroyBarang'])->name('barang.destroy');
    
    Route::get('/pengeluaran', [AdminController::class, 'pengeluaran'])->name('pengeluaran.index');
    Route::post('/pengeluaran/{id}/proses', [AdminController::class, 'prosesPengeluaran'])->name('pengeluaran.proses');
    
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan.index');
});

// Approval Routes
Route::middleware(['auth', 'role:approval'])->prefix('approval')->name('approval.')->group(function () {
    Route::get('/dashboard', [ApprovalController::class, 'index'])->name('dashboard');
    Route::post('/permintaan/{id}/validasi', [ApprovalController::class, 'validasi'])->name('permintaan.validasi');
    Route::post('/permintaan/{id}/revisi', [ApprovalController::class, 'revisi'])->name('permintaan.revisi');
    
    // User Management
    Route::get('/pengguna', [App\Http\Controllers\UserController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna', [App\Http\Controllers\UserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('pengguna.destroy');
});

// Karyawan Routes
Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [KaryawanController::class, 'index'])->name('dashboard');
    Route::get('/katalog', [KaryawanController::class, 'katalog'])->name('katalog');
    Route::get('/permintaan/create', [KaryawanController::class, 'createPermintaan'])->name('permintaan.create');
    Route::post('/permintaan', [KaryawanController::class, 'storePermintaan'])->name('permintaan.store');
    Route::get('/riwayat', [KaryawanController::class, 'riwayat'])->name('riwayat');
});

require __DIR__.'/auth.php';

