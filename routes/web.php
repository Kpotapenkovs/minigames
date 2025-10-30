<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [TypeController::class, 'index']);
Route::get('/memoryCard', [TypeController::class, 'memorycard'])->name('memoryCard');
Route::get('/typingGame', [TypeController::class, 'typegame'])->name('typingGame');