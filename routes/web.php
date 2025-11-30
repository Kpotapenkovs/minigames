<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\MinigamesController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CardGameController;

Route::get('/', [MinigamesController::class, 'index'])->name('minigames.index');
Route::post('/typinggame/check-nickname', [TypingController::class, 'checkNickname'])->name('typing.checkNickname');

Route::get('/memorycard', [TypeController::class, 'memorycard'])->name('memoryCard');

Route::get('/typingspeed', [TypingController::class, 'index'])->name('typingSpeed');

Route::get('/typinggame/random/{mode}', [TypingController::class, 'randomText'])->name('typing.random');

Route::post('/typinggame/save', [TypingController::class, 'saveResult'])->name('typing.save');

// ♠️ Kāršu spēle - sākuma skats
Route::get('/card-game', [CardGameController::class, 'index'])->name('card-game');

// 💾 Saglabā kāršu spēles rezultātu (AJAX)
Route::post('/card-game/save-score', [CardGameController::class, 'saveScore'])->name('save-score');
