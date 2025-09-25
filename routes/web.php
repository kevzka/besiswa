<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;



// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'publicDashboard']);
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->middleware('auth');
// Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth');

//
// Route::get('/', [ProductController::class, 'index']);
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Routes untuk autentikasi
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

//
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');