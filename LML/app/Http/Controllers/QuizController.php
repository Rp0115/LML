<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Define different sets of quiz questions.
     * The top-level key (e.g., 'linearReg') should match the quizId from the URL.
     */
    private $quizzes = [
        'linearReg' => [
            1 => ['question' => 'What is the capital of Japan?', 'options' => ['Beijing', 'Seoul', 'Tokyo', 'Bangkok'], 'answer' => 'Tokyo'],
            2 => ['question' => 'What does "SQL" stand for?', 'options' => ['Structured Query Language', 'Simple Question Language', 'Standard Query Logic', 'System Query Link'], 'answer' => 'Structured Query Language'],
            3 => ['question' => 'Which planet is known as the Red Planet?', 'options' => ['Earth', 'Mars', 'Jupiter', 'Venus'], 'answer' => 'Mars'],
            4 => ['question' => 'In what year did the first modern Olympic Games take place?', 'options' => ['1900', '1896', '1924', '1888'], 'answer' => '1896'],
            5 => ['question' => 'What is the main component of the sun?', 'options' => ['Liquid Lava', 'Gas', 'Molten Iron', 'Rock'], 'answer' => 'Gas'],
            6 => ['question' => 'Which of these is a programming language?', 'options' => ['HTML', 'JPEG', 'Python', 'CSS'], 'answer' => 'Python'],
            7 => ['question' => 'What is the largest ocean on Earth?', 'options' => ['Atlantic', 'Indian', 'Arctic', 'Pacific'], 'answer' => 'Pacific'],
            8 => ['question' => 'Who wrote the play "Romeo and Juliet"?', 'options' => ['Charles Dickens', 'William Shakespeare', 'Jane Austen', 'Mark Twain'], 'answer' => 'William Shakespeare'],
            9 => ['question' => 'What does a compiler do?', 'options' => ['Converts source code to machine code', 'Runs the program', 'Checks for viruses', 'Designs the user interface'], 'answer' => 'Converts source code to machine code'],
            10 => ['question' => 'What is the value of `x` after `x = 5; x++;`?', 'options' => ['5', '6', '4', 'Undefined'], 'answer' => '6']
        ],
        // ✅ New set of questions for Logistic Regression
        'logisticReg' => [
            1 => ['question' => 'Logistic Regression is primarily used for what type of problem?', 'options' => ['Regression', 'Clustering', 'Classification', 'Dimensionality Reduction'], 'answer' => 'Classification'],
            2 => ['question' => 'The output of a logistic regression model is a value between...?', 'options' => ['0 and 1', '-1 and 1', '0 and 100', 'Any real number'], 'answer' => '0 and 1'],
            3 => ['question' => 'What is the name of the S-shaped curve used in logistic regression?', 'options' => ['Hyperbola', 'Parabola', 'Sine Wave', 'Sigmoid Function'], 'answer' => 'Sigmoid Function'],
            // ... add more logistic regression questions
        ]
    ];

    /**
     * Display the quiz page dynamically based on the provided quiz ID.
     */
    public function show(string $quizId)
    {
        // Select the correct set of questions for the given quizId
        $questions = $this->quizzes[$quizId] ?? [];

        // Prepare questions for the view
        $quizQuestions = [];
        foreach ($questions as $id => $details) {
            $quizQuestions[$id] = [
                'question' => $details['question'],
                'options' => $details['options']
            ];
        }

        // Fetch the last score for the current user and this specific quiz
        $lastResult = DB::table('quiz_results')
            ->where('user_id', Auth::id())
            ->where('quiz_identifier', $quizId)
            ->first();

        // Dynamically determine where the "back" button should go
        $backRoute = in_array($quizId, ['linearReg', 'logisticReg', 'decisionTree'])
            ? route($quizId)
            : route('models'); // A sensible default

        // Pass all necessary data to the view
        return view('quiz', [
            'questions' => $quizQuestions,
            'lastScore' => $lastResult ? $lastResult->score : null,
            'backRoute' => $backRoute,
            'quizId' => $quizId
        ]);
    }

    /**
     * Handle the quiz submission, grade it, and save the score.
     */
    public function store(Request $request, string $quizId)
    {
        // Select the correct set of answers for grading
        $questions = $this->quizzes[$quizId] ?? [];

        $userAnswers = $request->input('answers', []);
        $correctAnswersCount = 0;
        
        // Grade the quiz against the correct answer set
        foreach ($questions as $id => $details) {
            if (isset($userAnswers[$id]) && $userAnswers[$id] === $details['answer']) {
                $correctAnswersCount++;
            }
        }
        
        // Calculate the score as a percentage
        $totalQuestions = count($questions);
        $score = ($totalQuestions > 0) ? round(($correctAnswersCount / $totalQuestions) * 100) : 0;

        // Save the score to the database using the dynamic quizId
        $userId = Auth::id();
        
        DB::table('quiz_results')->updateOrInsert(
            ['user_id' => $userId, 'quiz_identifier' => $quizId],
            ['score' => $score, 'created_at' => now(), 'updated_at' => now()]
        );

        // Redirect back to the same quiz page with the score
        return redirect()->route('quiz.show', ['quizId' => $quizId])
                         ->with('status', "Quiz submitted! Your new score is {$score}%");
    }
}