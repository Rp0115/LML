<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
})->middleware(['auth', 'verified'])->name('test');

Route::get('/test2', function () {
    return view('test2');
})->middleware(['auth', 'verified'])->name('test2');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); 

Route::get('/flashcards', function () {
    return view('flashcards');
})->middleware(['auth', 'verified'])->name('flashcards');

Route::get('/quiz', function () {
    return view('quiz');
})->middleware(['auth', 'verified'])->name('quiz');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
