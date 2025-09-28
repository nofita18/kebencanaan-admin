<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KejadianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kejadian', [KejadianController::class, 'index']);
