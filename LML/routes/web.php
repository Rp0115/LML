<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\NotebookController;

Route::get('/flashcards/{setId}', [FlashcardController::class, 'show'])->name('flashcards.show')->middleware('auth');

Route::get('/quiz/{quizId}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quizId}', [QuizController::class, 'store'])->name('quiz.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/desktop', function () {
    return view('desktop');
})->middleware(['auth', 'verified'])->name('desktop');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); 
    
Route::get('/models', function () {
    return view('models');
})->middleware(['auth', 'verified'])->name('models');

Route::get('/linearReg', function () {
    $topicId = 'linearReg';

    // Fetch the note content for the current user and topic
    $note = DB::table('notes')
        ->where('user_id', Auth::id())
        ->where('id', $topicId)
        ->first();

    // Pass the note content to the Blade view
    return view('linearReg', [
        'noteContent' => $note ? $note->content : ''
    ]);
})->middleware(['auth', 'verified'])->name('linearReg');

Route::get('/logisticReg', function () {
    $topicId = 'logisticReg';

    // Fetch the note content for the current user and topic
    $note = DB::table('notes')
        ->where('user_id', Auth::id())
        ->where('id', $topicId)
        ->first();

    // Pass the note content to the Blade view
    return view('logisticReg', [
        'noteContent' => $note ? $note->content : ''
    ]);
})->middleware(['auth', 'verified'])->name('logisticReg');

Route::get('/coming-soon', function () {
    return view('under_construction');
})->middleware('auth')->name('coming.soon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notebook', [NotebookController::class, 'index'])->name('notebook.index');
    Route::post('/notebook/save', [NotebookController::class, 'store'])->name('notebook.store');

    Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
});

require __DIR__.'/auth.php';
