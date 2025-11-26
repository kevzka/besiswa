<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortofolioController;

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::redirect('/', '/dashboard');
Route::redirect('/admin', '/admin/dashboard');

Route::get('/dashboard', [DashboardController::class, 'publicDashboard'])->name('dashboard');

Route::get('/bimbingan/{deg}', [UserViewController::class, 'bimbingan'])->name('bimbingan');
Route::get('/bimbingan/detail/{id}', [UserViewController::class, 'bimbinganDetail'])->name('bimbingan.detail');
Route::get('/prestasi/{deg}', [UserViewController::class, 'prestasi'])->name('prestasi');
Route::get('/prestasi/detail/{id}', [UserViewController::class, 'prestasiDetail'])->name('prestasi.detail');
Route::get('/ekskul/{deg}', [UserViewController::class, 'ekskul'])->name('ekskul');
Route::get('/ekskul/detail/{id}', [UserViewController::class, 'ekskulDetail'])->name('ekskul.detail');
Route::get('/portofolio/{deg}', [UserViewController::class, 'portofolio'])->name('portofolio');
Route::get('/portofolio/angkatan/{id}', [UserViewController::class, 'portofolioDetail'])->name('portofolio.detail');

// Admin Routes
// hilangkkan middleware auth
// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [CrudController::class, 'home'])->name('dashboard');
    Route::resource('bimbingan', CrudController::class)->parameters(['bimbingan' => 'kegiatan'])->names('bimbingan');
    Route::resource('prestasi', CrudController::class)->parameters(['prestasi' => 'kegiatan'])->names('prestasi');
    Route::resource('ekskul', CrudController::class)->parameters(['ekskul' => 'kegiatan'])->names('ekskul');
    Route::resource('portofolio', PortofolioController::class)->names('portofolio');
    Route::get('profile', [DashboardController::class, 'profileDashboard'])->name('profile');
});
//bikinkan kode auto login

if (app()->environment('local')) {
    /**
     * Dev-only auto login for Postman.
     * Usage: GET /dev-login/{id}?token=SECRET_TOKEN
     * Response sets session cookie and XSRF-TOKEN cookie and returns csrf_token + user.
     */
    Route::get('/dev-login/{id}', function ($id) {
        if (env('AUTO_LOGIN_TOKEN') && request()->query('token') !== env('AUTO_LOGIN_TOKEN')) {
            abort(403, 'Forbidden');
        }

        $userModel = config('auth.providers.users.model');
        $user = $userModel::findOrFail($id);

        \Illuminate\Support\Facades\Auth::login($user);

        // regenerate session id
        session()->regenerate();

        $lifetime = config('session.lifetime'); // minutes

        return response()->json([
            'message' => 'dev login ok',
            'user' => $user,
            'csrf_token' => csrf_token(),
            'session_name' => session()->getName(),
            'session_id' => session()->getId(),
        ])
        // set Laravel session cookie so Postman receives it
        ->withCookie(cookie(session()->getName(), session()->getId(), $lifetime))
        // set XSRF-TOKEN cookie so frontends can read it
        ->withCookie(cookie('XSRF-TOKEN', csrf_token(), $lifetime));
    })->name('dev.login');
}

Route::get('/tes', function () {
    return view('tes');
});

//kirim kode csrf sesudah login
ROute::get('/csrf-token', function() {
    return csrf_token();
});

Route::get('/tesbimbingan', function () {
    return view('user.bimbingan.show');
});

// Route::get('/search', [ProductController::class, 'search'])->name('products.search');
?>