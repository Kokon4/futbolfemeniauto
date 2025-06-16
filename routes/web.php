<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\ClassificacioController;
use App\Http\Controllers\CalendariController;
use App\Http\Middleware\RoleMiddleware;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/classificacio', [ClassificacioController::class, 'index'])->name('classificacio.index');
    Route::resource('/jugadores', JugadoraController::class)->only(['index', 'show']);
    Route::resource('/partits', PartitController::class)->only(['index', 'show']);

    Route::get('/calendari', [CalendariController::class, 'index'])->name('calendari.index');
    Route::get('/calendari/edit/{partit}', [CalendariController::class, 'edit'])->name('calendari.edit');
    Route::put('/calendari/update/{partit}', [CalendariController::class, 'update'])->name('calendari.update');

    Route::middleware([RoleMiddleware::class.':administrador'])->group(function () {
        Route::resource('/equips', EquipController::class)->except(['index', 'show']);
        Route::resource('/estadis', EstadiController::class)->except(['index', 'show']);
    });

    Route::middleware([RoleMiddleware::class.':manager'])->group(function () {
        Route::resource('/jugadores', JugadoraController::class)->except(['index', 'show']);
    });

    Route::middleware([RoleMiddleware::class.':arbitre'])->group(function () {
        Route::resource('/partits', PartitController::class)->except(['index', 'show']);
    });
});

Route::resource('/equips', EquipController::class)->only(['index', 'show']);
Route::resource('/estadis', EstadiController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';

