<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcards</title>
    {{-- This uses Laravel's asset helper to correctly link to your CSS file in the public directory --}}
    <link rel="stylesheet" href='{{ asset("css/flashcardstyle.css") }}'>
</head>

<body>
    {{-- This is the main container for your flashcard application --}}
    <div class="container">
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
            <span class="progress-text" id="progressText">0/0</span>
        </div>
        
        <div class="flashcard-container">
            <div class="flashcard" id="flashcard">
                <div class="flashcard-inner" id="flashcardInner">
                    <div class="flashcard-front">
                        <p id="term">Loading flashcards...</p>
                    </div>
                    <div class="flashcard-back">
                        <p id="definition"></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="navigation-buttons">
            <button id="prevBtn" disabled>Previous</button>
            <button id="flipBtn">Flip Card</button>
            <button id="nextBtn" disabled>Next</button>
        </div>
    </div>

    {{-- Your inline JavaScript data --}}
    <script>
        const flashcardData = [
            {
                "term": "Bias",
                "definition": "The error introduced by approximating a real-world problem with a simplified model."
            },
            {
                "term": "Variance",
                "definition": "The amount that the predicted value would change if we estimated it using a different training dataset."
            },
            {
                "term": "Overfitting",
                "definition": "When a model learns the training data too well, including its noise and outliers, resulting in poor performance on new data."
            }
        ];
    </script>
    {{-- This links to your main JavaScript file in the public/js directory --}}
    <script src='{{ asset("js/flashcardscript.js") }}'></script>
</body>
</x-app-layout>