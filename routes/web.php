<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\MinigamesController;
use App\Http\Controllers\TypeController;

Route::get('/', [MinigamesController::class, 'index'])->name('minigames.index');
Route::post('/typinggame/check-nickname', [TypingController::class, 'checkNickname'])->name('typing.checkNickname');

Route::get('/memorycard', [TypeController::class, 'memorycard'])->name('memoryCard');

Route::get('/typingspeed', [TypingController::class, 'index'])->name('typingSpeed');

Route::get('/typinggame/random/{mode}', [TypingController::class, 'randomText'])->name('typing.random');

Route::post('/typinggame/save', [TypingController::class, 'saveResult'])->name('typing.save');
