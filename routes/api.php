<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathController;

// Default bawaan Laravel (biarkan tetap ada)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tambahkan route untuk MathController
Route::get('/add', [MathController::class, 'add']);
