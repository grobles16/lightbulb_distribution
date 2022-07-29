<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LightBulbController;


Route::get('/'              ,[HomeController::class, 'index'])->name('home');
Route::get('/room'          ,[RoomController::class, 'index'])->name('room.index');
Route::post('/room/store'   ,[RoomController::class, 'store'])->name('room.store');

Route::get('/lightbulb'     ,[LightbulbController::class, 'index'])->name('lightbulb.index');