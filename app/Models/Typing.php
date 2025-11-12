<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typing extends Model
{
    protected $table = 'typing_texts';
    protected $fillable = ['mode', 'text'];
}
