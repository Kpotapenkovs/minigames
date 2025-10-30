<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return view('index');
    }
     public function memorycard()
    {
        return view('memoryCard');
    }

    public function typegame()
    {
        return view('typingGame');
    }
}
