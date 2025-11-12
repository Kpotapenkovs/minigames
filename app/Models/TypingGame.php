<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypingGame extends Model
{
    protected $table = 'typing_game';
    protected $fillable = ['nickname', 'mode', 'time'];
}
