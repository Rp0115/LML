<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    /**
     * Define different sets of flashcards.
     */
    private $flashcardSets = [
        'linearReg' => [
            ['term' => 'Dependent Variable', 'definition' => 'The variable being predicted or explained (Y-axis).'],
            ['term' => 'Independent Variable', 'definition' => 'The variable used to predict the dependent variable (X-axis).'],
            ['term' => 'Best-fit Line', 'definition' => 'The line that minimizes the sum of squared differences between predicted and actual values.'],
            ['term' => 'Residual', 'definition' => 'The vertical distance between an actual data point and the regression line; the prediction error.'],
            ['term' => 'R-squared (R²)', 'definition' => 'A statistical measure representing the proportion of the variance for a dependent variable that is explained by an independent variable.'],
            ['term' => 'Slope (m)', 'definition' => 'Indicates how much the dependent variable (Y) is expected to change for a one-unit change in the independent variable (X).'],
            ['term' => 'Intercept (b)', 'definition' => 'The predicted value of the dependent variable (Y) when the independent variable (X) is zero.'],
            ['term' => 'Homoscedasticity', 'definition' => 'An assumption that the variance of the residuals is constant across all levels of the independent variable.'],
            ['term' => 'Cost Function', 'definition' => 'A function that measures the performance of a model by quantifying the difference between predicted and actual values.'],
            ['term' => 'Mean Squared Error (MSE)', 'definition' => 'A common cost function for linear regression that calculates the average of the squared residuals.'],
            ['term' => 'Gradient Descent', 'definition' => 'An optimization algorithm used to find the values of model parameters (slope and intercept) that minimize the cost function.'],
            ['term' => 'Learning Rate', 'definition' => 'A hyperparameter in gradient descent that determines the step size at each iteration while moving toward a minimum of a cost function.'],
            ['term' => 'Multiple Linear Regression', 'definition' => 'A type of linear regression that uses two or more independent variables to predict a single dependent variable.'],
            ['term' => 'Multicollinearity', 'definition' => 'A phenomenon where two or more independent variables in a multiple regression model are highly correlated with each other.'],
            ['term' => 'P-value', 'definition' => 'In regression, it indicates the probability of observing the data if the independent variable has no effect on the dependent variable.'],
        ],
        'logisticReg' => [
            ['term' => 'Sigmoid Function', 'definition' => 'An S-shaped curve that maps any real-valued number into a value between 0 and 1, representing a probability.'],
            ['term' => 'Binary Classification', 'definition' => 'A prediction task with two possible, mutually exclusive outcomes (e.g., Yes/No, Spam/Not Spam).'],
            ['term' => 'Logit (Log-odds)', 'definition' => 'The natural logarithm of the odds. Logistic regression models the logit as a linear function of the independent variables.'],
            ['term' => 'Odds Ratio', 'definition' => 'The ratio of the odds of an event occurring in one group to the odds of it occurring in another group.'],
            ['term' => 'Decision Boundary', 'definition' => 'A threshold or surface that separates the different classes. In logistic regression, this is typically set at a probability of 0.5.'],
            ['term' => 'Maximum Likelihood Estimation (MLE)', 'definition' => 'The method used to find the best-fitting model parameters (coefficients) by maximizing the likelihood that the model would generate the observed data.'],
            ['term' => 'Log Loss (Cross-Entropy)', 'definition' => 'A common cost function for logistic regression that quantifies the accuracy of a classifier by penalizing false classifications.'],
            ['term' => 'Confusion Matrix', 'definition' => 'A table used to evaluate the performance of a classification model by showing true positives, true negatives, false positives, and false negatives.'],
            ['term' => 'Accuracy', 'definition' => 'A performance metric calculated as the ratio of correctly predicted instances to the total number of instances.'],
            ['term' => 'Precision', 'definition' => 'A metric that measures the accuracy of positive predictions, calculated as True Positives / (True Positives + False Positives).'],
            ['term' => 'Recall (Sensitivity)', 'definition' => 'A metric that measures the model\'s ability to identify all relevant instances, calculated as True Positives / (True Positives + False Negatives).'],
            ['term' => 'F1-Score', 'definition' => 'The harmonic mean of Precision and Recall, providing a single score that balances both metrics.'],
            ['term' => 'Regularization', 'definition' => 'A technique (like L1 or L2) used to prevent overfitting by adding a penalty term to the cost function.'],
            ['term' => 'Overfitting', 'definition' => 'When a model learns the training data too well, including its noise, leading to poor performance on new, unseen data.'],
            ['term' => 'Multinomial Logistic Regression', 'definition' => 'An extension of logistic regression used for classification problems with more than two possible outcomes that have no natural ordering.'],
        ],
        // Add other flashcard sets here...
    ];

    /**
     * Display the flashcard page for a specific set.
     */
    public function show(string $setId)
    {
        // Select the correct set of flashcards, or an empty array if not found
        $flashcards = $this->flashcardSets[$setId] ?? [];

        // Determine the route for the "back" button
        $backRoute = in_array($setId, ['linearReg', 'logisticReg', 'decisionTree'])
            ? route($setId)
            : route('models'); // A sensible default

        return view('flashcards', [
            'flashcards' => $flashcards,
            'backRoute' => $backRoute
        ]);
    }
}