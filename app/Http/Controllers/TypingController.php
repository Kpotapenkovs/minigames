<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typing;
use Illuminate\Support\Facades\DB;

class TypingController extends Controller
{
    /**
     * Parāda spēles sākuma lapu
     */
    public function index()
    {
        return view('typinggame.index');
    }

    /**
     * Atgriež random tekstu no DB (pēc mode)
     */
    public function randomText($mode)
    {
        $text = DB::table('typing_texts')
            ->where('mode', $mode)
            ->inRandomOrder()
            ->first();

        if (!$text) {
            return response()->json(['error' => 'No text found for mode ' . $mode], 404);
        }

        return response()->json(['text' => $text->text]);
    }

    /**
     * Saglabā spēles rezultātu DB
     */
    public function saveResult(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'mode' => 'required|string|in:easy,medium,hard,hardcore',
            'time' => 'required|numeric|min:0',
        ]);

        DB::table('typing_game')->insert([
            'nickname' => $validated['nickname'],
            'mode' => $validated['mode'],
            'time' => $validated['time'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
