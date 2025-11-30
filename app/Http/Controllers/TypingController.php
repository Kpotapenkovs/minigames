<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typing;
use Illuminate\Support\Facades\DB;

class TypingController extends Controller
{
public function checkNickname(Request $request)
{
    $nickname = $request->input('nickname');

    $exists = DB::table('typing_game')->where('nickname', $nickname)->exists();

    return response()->json(['exists' => $exists]);
}


    public function index()
    {
        return view('typinggame.index');
    }


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


    public function saveResult(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'mode' => 'required|string|in:easy,medium,hard,hardcore',
            'time' => 'required|numeric|min:0',
             'wpm' => 'required|numeric|min:0'
        ]);

        DB::table('typing_game')->insert([
            'nickname' => $validated['nickname'],
            'mode' => $validated['mode'],
            'time' => $validated['time'],
            'wpm' => $validated['wpm'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
