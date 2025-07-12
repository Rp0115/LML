<x-app-layout>
    <link rel="stylesheet" href='{{asset("css/quizstyle.css")}}'>
    
    <div class="quiz-wrapper">
        <div id="quiz-container">
            <div id="question-container">
                <div id="question-header">Question <span id="question-number">1</span> of 10</div>
                <p id="question-text">This is where the question will go.</p>
                <div id="answer-buttons" class="btn-grid">
                    </div>
                <div id="navigation">
                    <button id="next-btn">Next</button>
                </div>
            </div>
        
            <div id="results-container" style="display: none;">
                <h2>Quiz Complete!</h2>
                <p id="score-text">Your score will be shown here.</p>
                <button id="restart-btn">Restart Quiz</button>
            </div>
        </div>
    </div>

    <script src='{{ asset("js/quizscript.js") }}'></script>
</x-app-layout>