<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\DashboardController;
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
