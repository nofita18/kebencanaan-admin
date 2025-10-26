<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\KejadianBencanaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kejadian', [KejadianController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('warga', WargaController::class);
Route::resource('kejadian-bencana', KejadianBencanaController::class);

Route::get('/awalan', function () {
    return view('admin.awalan');
});

Route::resource('users', UserController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'process'])->name('login.process');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::resource('posko-bencana', PoskoBencanaController::class);
