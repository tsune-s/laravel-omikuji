<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MemoController;

Route::get('/', [MemoController::class, 'index']);
Route::post('/store', [MemoController::class, 'store']);


use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::post('/store', [TodoController::class, 'store']);
Route::post('/toggle/{id}', [TodoController::class, 'toggle']);
Route::post('/delete/{id}', [TodoController::class, 'destroy']);


use App\Http\Controllers\OmikujiController;

Route::get('/omikuji', [OmikujiController::class, 'index']);
Route::post('/omikuji/result', [OmikujiController::class, 'result']);
