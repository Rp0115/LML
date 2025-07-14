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
        ],
        'logisticReg' => [
            ['term' => 'Sigmoid Function', 'definition' => 'An S-shaped curve that maps any real-valued number into a value between 0 and 1.'],
            ['term' => 'Binary Classification', 'definition' => 'A prediction task with two possible outcomes (e.g., Yes/No, True/False).'],
        ]
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