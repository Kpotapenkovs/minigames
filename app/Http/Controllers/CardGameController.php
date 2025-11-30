<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardGameController extends Controller
{
    public function index()
    {
        return view('card-game.index');
    }

    public function saveScore(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|in:easy,medium,hard',
            'time' => 'required|integer|min:0',
            'moves' => 'required|integer|min:0',
        ]);

        // Store in session or database as needed
        // For now, we'll return success
        return response()->json(['success' => true]);
    }
}
