<?php

use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonationController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/events');
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

    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');
    // Route untuk menampilkan halaman form
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

    Route::get('/events/{id}', [EventController::class, 'show'])
        ->name('events.show');

    Route::get('/profil', [AuthController::class, 'profile'])
        ->name('profil');

    Route::get('/profil/edit', [AuthController::class, 'editProfile'])
        ->name('profil.edit');

    Route::post('/profil/edit', [AuthController::class, 'updateProfile'])
        ->name('profil.update');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    // Route untuk menerima kiriman data form
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');

    // Route untuk menampilkan halaman form
    Route::get('/tree/create', [TreeController::class, 'create'])->name('trees.create');

    // Route untuk menerima kiriman data form
    Route::post('/tree/store', [TreeController::class, 'store'])->name('trees.store');

    Route::post('/donations/store',[DonationController::class, 'store'])
        ->name('donations.store');
    });


