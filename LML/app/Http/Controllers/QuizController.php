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
            1 => [
                'question' => 'Linear Regression is best suited for predicting what kind of values?', 
                'options' => ['Categorical', 'Continuous', 'Discrete', 'Boolean'], 
                'answer' => 'Continuous'
            ],
            2 => [
                'question' => 'The primary goal of linear regression is to minimize the...', 
                'options' => ['Number of data points', 'Correlation coefficient', 'Sum of squared residuals', 'Number of variables'], 
                'answer' => 'Sum of squared residuals'
            ],
            3 => [
                'question' => 'In the equation Y = mX + b, what does "b" represent?', 
                'options' => ['The slope', 'The Y-intercept', 'The independent variable', 'The prediction error'], 
                'answer' => 'The Y-intercept'
            ],
            4 => [
                'question' => 'What does a high R-squared (R²) value indicate?', 
                'options' => ['A strong, positive correlation', 'The model explains a large portion of the variance', 'The model is overfit', 'The relationship is not linear'], 
                'answer' => 'The model explains a large portion of the variance'
            ],
            5 => [
                'question' => 'The difference between an observed value and the value predicted by the regression line is called a...', 
                'options' => ['Variable', 'P-value', 'Standard deviation', 'Residual'], 
                'answer' => 'Residual'
            ],
            6 => [
                'question' => 'What optimization algorithm is commonly used to find the best-fit line in linear regression?', 
                'options' => ['K-Means Clustering', 'Decision Tree', 'Gradient Descent', 'Support Vector Machine'], 
                'answer' => 'Gradient Descent'
            ],
            7 => [
                'question' => 'A linear regression model with two or more independent variables is known as...', 
                'options' => ['Simple Linear Regression', 'Polynomial Regression', 'Multiple Linear Regression', 'Logistic Regression'], 
                'answer' => 'Multiple Linear Regression'
            ],
            8 => [
                'question' => 'What is a core assumption of linear regression?', 
                'options' => ['The variables must be categorical', 'A linear relationship exists between variables', 'The data must contain outliers', 'All variables must be independent of each other'], 
                'answer' => 'A linear relationship exists between variables'
            ],
            9 => [
                'question' => 'In the context of gradient descent, what is the "learning rate"?', 
                'options' => ['The speed of the computer', 'The number of correct predictions', 'The size of the steps taken towards the minimum', 'The total number of data points'], 
                'answer' => 'The size of the steps taken towards the minimum'
            ],
            10 => [
                'question' => 'When two or more independent variables are highly correlated, this problem is known as...', 
                'options' => ['Homoscedasticity', 'Autocorrelation', 'Overfitting', 'Multicollinearity'], 
                'answer' => 'Multicollinearity'
            ],
        ],
        // ✅ New set of questions for Logistic Regression
        'logisticReg' => [
            1 => [
                'question' => 'Logistic Regression is primarily used for what type of problem?', 
                'options' => ['Regression', 'Clustering', 'Classification', 'Dimensionality Reduction'], 
                'answer' => 'Classification'
            ],
            2 => [
                'question' => 'The output of a logistic regression model typically represents a...?', 
                'options' => ['Continuous value', 'Probability', 'Cluster ID', 'Squared error'], 
                'answer' => 'Probability'
            ],
            3 => [
                'question' => 'What is the name of the S-shaped curve used in logistic regression?', 
                'options' => ['Hyperbola', 'Parabola', 'Sine Wave', 'Sigmoid Function'], 
                'answer' => 'Sigmoid Function'
            ],
            4 => [
                'question' => 'A decision boundary in logistic regression...', 
                'options' => ['Connects the data points', 'Measures the error', 'Separates the different classes', 'Is always a straight line'], 
                'answer' => 'Separates the different classes'
            ],
            5 => [
                'question' => 'Which cost function is most commonly used for training a logistic regression model?', 
                'options' => ['Mean Squared Error', 'Root Mean Squared Error', 'Log Loss (Cross-Entropy)', 'Mean Absolute Error'], 
                'answer' => 'Log Loss (Cross-Entropy)'
            ],
            6 => [
                'question' => 'If a model correctly identifies all actual positive cases, it has a high...', 
                'options' => ['Precision', 'Accuracy', 'Recall', 'F1-Score'], 
                'answer' => 'Recall'
            ],
            7 => [
                'question' => 'What is the term for a prediction task with only two possible outcomes, like "Yes" or "No"?', 
                'options' => ['Multinomial Classification', 'Linear Regression', 'Clustering', 'Binary Classification'], 
                'answer' => 'Binary Classification'
            ],
            8 => [
                'question' => 'Adding a penalty term to the cost function to prevent overfitting is known as...', 
                'options' => ['Gradient Descent', 'Regularization', 'Normalization', 'Standardization'], 
                'answer' => 'Regularization'
            ],
            9 => [
                'question' => 'The natural logarithm of the odds is also known as the...', 
                'options' => ['Logit function', 'Likelihood', 'P-value', 'Residual'], 
                'answer' => 'Logit function'
            ],
            10 => [
                'question' => 'If your model has high precision but low recall, what is likely happening?', 
                'options' => ['It correctly predicts most positives', 'It predicts positives very accurately, but misses many', 'It is perfectly balanced', 'It has high accuracy'], 
                'answer' => 'It predicts positives very accurately, but misses many'
            ],
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