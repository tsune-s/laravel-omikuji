<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::latest()->get();
        return view('index', compact('memos'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required']);
        Memo::create($request->only('content'));
        return redirect('/');
    }
}
