<?php

use App\Http\COntrollers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
Route::get('/test', function () {
    return User::all();
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/pohon');
    }

    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/pohon', [TreeController::class, 'index'])->name('pohon');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



Route::get('/debug-auth', function () {
    return [
        'check' => Auth::check(),
        'id' => Auth::id(),
        'user' => Auth::user()?->username,
    ];
});
    