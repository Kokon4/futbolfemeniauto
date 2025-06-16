<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;

Route::view('/', 'welcome');
Route::resource('/equips',EquipController::class);
Route::resource('/estadis',EstadiController::class);
Route::resource('/jugadores',JugadoraController::class);
Route::resource('/partits',PartitController::class);

?>