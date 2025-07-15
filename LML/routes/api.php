<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

// Group routes that require authentication


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
