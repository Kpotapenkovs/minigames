<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\MinigamesController;
use App\Http\Controllers\CardGameController;

// 🎮 Galvenā minigame lapa
Route::get('/', [MinigamesController::class, 'index'])->name('minigames.index');

// 🧠 Typing spēle - sākuma skats
Route::get('/typingspeed', [TypingController::class, 'index'])->name('typing.index');

// 🔀 Saņem random tekstu pēc izvēlētā mode (AJAX)
Route::get('/typinggame/random/{mode}', [TypingController::class, 'randomText'])->name('typing.random');

// 💾 Saglabā spēles rezultātu (AJAX)
Route::post('/typinggame/save', [TypingController::class, 'saveResult'])->name('typing.save');

// ♠️ Kāršu spēle - sākuma skats
Route::get('/card-game', [CardGameController::class, 'index'])->name('card-game');

// 💾 Saglabā kāršu spēles rezultātu (AJAX)
Route::post('/card-game/save-score', [CardGameController::class, 'saveScore'])->name('save-score');
