<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\LogistikBencanaController;
use App\Http\Controllers\DistribusiLogistikController;

//Route Utama (bisa di akses tanpa login)
// Redirect default → login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'process'])->name('login.process');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route yg butuh login
Route::middleware('checkislogin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard.dashboard');
    })->name('dashboard');

                                                     // CRUD
    Route::resource('users', UserController::class); //->middleware('checkrole:admin');
    Route::resource('warga', WargaController::class);
    Route::resource('kejadian-bencana', KejadianBencanaController::class);
    Route::resource('posko-bencana', PoskoBencanaController::class);
    Route::resource('donasi-bencana', DonasiBencanaController::class);
    Route::resource('logistik-bencana', LogistikBencanaController::class);
    Route::resource('distribusi-logistik', DistribusiLogistikController::class);

    Route::get('/kejadian', [KejadianController::class, 'index']);

    Route::get('/developer/profile', function () {
        return view('pages.developer.profile');
    })->name('developer.profile');

});

Route::get('/logout', function () {
    abort(405); // GET tidak diizinkan
});
