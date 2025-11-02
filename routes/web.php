<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerformaController;

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'publicDashboard']);

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [CrudController::class, 'home'])->name('dashboard');
    Route::resource('bimbingan', CrudController::class)->parameters(['bimbingan' => 'kegiatan'])->names('bimbingan');
    Route::resource('prestasi', CrudController::class)->parameters(['prestasi' => 'kegiatan'])->names('prestasi');
    Route::resource('ekskul', CrudController::class)->parameters(['ekskul' => 'kegiatan'])->names('ekskul');
    Route::get('profile', [DashboardController::class, 'profileDashboard'])->name('profile');
});

Route::middleware('auth')->group(function () {
Route::resource('tes', PerformaController::class);
})

// Route::get('/search', [ProductController::class, 'search'])->name('products.search');
?>