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

    Route::get('/events/{id}/edit', [EventController::class, 'edit'])
        ->name('events.edit');

    Route::put('/events/{id}', [EventController::class, 'update'])
        ->name('events.update');

    Route::get('/profil', [AuthController::class, 'profile'])
        ->name('profil');

    Route::get('/profil/edit', [AuthController::class, 'editProfile'])
        ->name('profil.edit');

    Route::post('/profil/edit', [AuthController::class, 'updateProfile'])
        ->name('profil.update');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');

    Route::get('/events/{id}/trees/create',
    [TreeController::class, 'createForEvent'])
    ->name('events.trees.create');

    Route::post('/events/{id}/trees/store',
    [TreeController::class, 'storeForEvent'])
    ->name('events.trees.store');

    Route::post('/donations/store',[DonationController::class, 'store'])
        ->name('donations.store');
    
Route::get('/tree/create',
    [TreeController::class, 'create'])
    ->name('trees.create');

Route::post('/tree/store',
    [TreeController::class, 'store'])
    ->name('trees.store');

Route::get(
    '/events/{event}/trees/{tree}/remove',
    [TreeController::class, 'removeFromEvent']
)->name('events.trees.remove');

Route::get(
    '/events/delete/select',
    [EventController::class, 'deleteForm']
)->name('events.delete.form');

Route::post(
    '/events/delete/multiple',
    [EventController::class, 'deleteMultiple']
)->name('events.delete.multiple');

Route::get('/trees/delete/select', [TreeController::class, 'deleteForm'])
    ->name('trees.delete.form');

Route::post('/trees/delete/multiple', [TreeController::class, 'deleteMultiple'])
    ->name('trees.delete.multiple');
});



