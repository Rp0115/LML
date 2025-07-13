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

Route::get('/desktop', function () {
    return view('desktop');
})->middleware(['auth', 'verified'])->name('desktop');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); 

Route::get('/flashcards', function () {
    return view('flashcards');
})->middleware(['auth', 'verified'])->name('flashcards');

Route::get('/quiz', function () {
    return view('quiz');
})->middleware(['auth', 'verified'])->name('quiz');

Route::get('/voila', function () {
    return view('voila');
})->middleware(['auth', 'verified'])->name('voila');

Route::get('/models', function () {
    return view('models');
})->middleware(['auth', 'verified'])->name('models');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
