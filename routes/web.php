<?php

use App\Http\COntrollers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Models\User;

Route::redirect('/', '/login');

Route::get('/test', function () {
    return User::all();
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::get('/pohon', [TreeController::class, 'index']);
