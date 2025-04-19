<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OmikujiController; // ← ここも追加

Route::get('/', [OmikujiController::class, 'index']);