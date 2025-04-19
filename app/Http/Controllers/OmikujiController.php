<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OmikujiController extends Controller
{
    public function index()
    {
        $fortunes = ['大吉', '中吉', '小吉', '末吉', '凶'];
        $messages = [
            '今日は最高の日！✨',
            '少しずつ前進しよう💪',
            'コツコツが大事📚',
            '気楽に行こう😌',
            '慎重にね…😱'
        ];

        $index = rand(0, count($fortunes) - 1);

        return view('omikuji', [
            'name' => 'うんこまん', // ここは任意に
            'fortune' => $fortunes[$index],
            'message' => $messages[$index]
        ]);
    }
}
