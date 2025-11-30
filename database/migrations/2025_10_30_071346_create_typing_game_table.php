<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('typing_game', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->float('time');
            $table->enum('mode', ['easy', 'medium', 'hard', 'hardcore']);
            $table->float('wpm')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('typing_game');
    }
};

