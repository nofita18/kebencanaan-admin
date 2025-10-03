<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kejadian', [KejadianController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
