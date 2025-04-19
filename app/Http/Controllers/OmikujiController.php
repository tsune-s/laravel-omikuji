<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OmikujiController extends Controller
{
    public function index()
    {
        return view('omikuji');
    }

    public function result(Request $request)
    {
        $request->validate(['name' => 'required|string|max:20']);

        $name = $request->input('name');

        $fortunes = [
            '大吉' => '✨最高の1日があなたを待っている！',
            '中吉' => '🌟ちょっといいことが起きる予感！',
            '吉'   => '😌 そこそこ良い感じかも！',
            '小吉' => '🙂 少し控えめに行動すると吉！',
            '凶'   => '😱 今日は慎重にいこう…！',
        ];

        $fortuneKey = array_rand($fortunes);
        $message = $fortunes[$fortuneKey];

        return view('omikuji_result', compact('name', 'fortuneKey', 'message'));
    }
}
