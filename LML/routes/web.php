<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\NotebookController;

Route::middleware('auth')->group(function () {
    // ... your other routes ...

    Route::get('/notebook', [NotebookController::class, 'index'])->name('notebook.index');
    Route::post('/notebook/save', [NotebookController::class, 'store'])->name('notebook.store');
});

Route::get('/flashcards/{setId}', [FlashcardController::class, 'show'])
     ->name('flashcards.show')
     ->middleware('auth');

// Route::middleware('auth')->group(function () {
//     // ... your other routes

//     Route::get('/quiz', [QuizController::class, 'show'])->name('quiz.show');
//     Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
// });

Route::get('/quiz/{quizId}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quizId}', [QuizController::class, 'store'])->name('quiz.store');

Route::middleware('auth')->group(function () {
    // ... other authenticated routes like /profile

    // ✅ Paste your note routes here
    Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
});

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

// Route::get('/flashcards', function () {
//     return view('flashcards');
// })->middleware(['auth', 'verified'])->name('flashcards');

Route::get('/voila', function () {
    return view('voila');
})->middleware(['auth', 'verified'])->name('voila');

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

// Route::get('/notebooks', function(){
//     return view('notebooks');
// })->middleware(['auth', 'verified'])->name('notebooks');

// Route::post('/save-notes', [NoteController::class, 'store'])->name('notes.store');

Route::get('/coming-soon', function () {
    return view('under_construction');
})->middleware('auth')->name('coming.soon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
