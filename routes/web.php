<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SettingController;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Auth Routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Lupa Password (Simple Static Page)
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Profil Kelurahan (bisa diakses semua yang login)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Kelurahan
    Route::get('/profil', [SettingController::class, 'profilKelurahan'])->name('profil');

    // Complaints index
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

    // Warga: create & store (HARUS sebelum /{complaint} agar 'create' tidak ditangkap sbg ID)
    Route::middleware('role:warga')->group(function () {
        Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
        Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    });

    // Show detail (setelah create agar tidak bentrok)
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // Ubah Password (semua user login)
    Route::get('/ubah-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/ubah-password', [AuthController::class, 'changePassword'])->name('password.update');

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        // Update status pengaduan
        Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])
            ->name('complaints.updateStatus');

        // Upload file penyelesaian
        Route::post('/complaints/{complaint}/upload-file', [ComplaintController::class, 'uploadFile'])
            ->name('complaints.uploadFile');

        // Tanggapan
        Route::post('/complaints/{complaint}/responses', [ResponseController::class, 'store'])
            ->name('responses.store');

        // Manajemen pengguna
        Route::resource('users', UserController::class);

        // Kategori
        Route::resource('categories', ComplaintCategoryController::class);

        // Statistik
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

        // Pengaturan / Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
