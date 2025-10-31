<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;


Route::redirect('/', '/dashboard', 302);
Route::get('/dashboard', function(){
    return view('public.dashboard');
})->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function(){
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('bimbingan', CrudController::class)->parameters(['bimbingan' => 'kegiatan'])->names('bimbingan');
    
});

/* use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesPageController;
 */



/* // Authentication Routes
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
<<<<<<< Updated upstream
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::resource('bimbingan', CrudController::class)->parameters(['bimbingan' => 'kegiatan'])->names('bimbingan');
    Route::resource('prestasi', CrudController::class)->parameters(['prestasi' => 'kegiatan'])->names('prestasi');
    Route::resource('ekskul', CrudController::class)->parameters(['ekskul' => 'kegiatan'])->names('ekskul');
=======
Route::middleware('jwt.auth')->group(function () {
    Route::get('admin/dashboard', [CrudController::class, 'home'])->name('admin.dashboard');
>>>>>>> Stashed changes
});
// Route::middleware('jwt.auth')->prefix('admin')->name('admin.')->group(function () {
//     Route::get('dashboard', [CrudController::class, 'home'])->name('dashboard');
//     Route::resource('bimbingan', CrudController::class)->parameters(['bimbingan' => 'kegiatan'])->names('bimbingan');
//     Route::resource('prestasi', CrudController::class)->parameters(['prestasi' => 'kegiatan'])->names('prestasi');
//     Route::resource('ekskul', CrudController::class)->parameters(['ekskul' => 'kegiatan'])->names('ekskul');
//     Route::get('profile', [DashboardController::class, 'profileDashboard'])->name('profile');
// });

<<<<<<< Updated upstream
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
<<<<<<< HEAD
=======
Route::get('tes', [AuthController::class, 'tes']);

// Route::get('/search', [ProductController::class, 'search'])->name('products.search');
>>>>>>> Stashed changes
=======
 */
>>>>>>> de2976d1f8a02678e9b2b132c59591be0a3b0b43
