<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcards</title>
    <link rel="stylesheet" href='{{asset("css/flashcardstyle.css")}}'>
</head>
<body>
    <div class="title-bar">
        <div class="title-bar-page-name">Flashcards</div>
        <a href="{{ $backRoute }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="page-wrapper">
        <div class="container">
            <h1>Flashcards</h1>
            <div class="flashcard-container">
                <div class="flashcard" id="flashcard">
                    <div class="flashcard-front"><p id="term">Loading...</p></div>
                    <div class="flashcard-back"><p id="definition"></p></div>
                </div>
            </div>
            <div class="navigation-buttons">
                <button id="prevBtn">Previous</button>
                <span class="progress-text" id="progressText"></span>
                <button id="nextBtn">Next</button>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    // ✅ Get flashcard data passed from the controller
    const flashcardData = @json($flashcards);

    // DOM Elements
    const flashcard = document.getElementById('flashcard');
    const termEl = document.getElementById('term');
    const definitionEl = document.getElementById('definition');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const progressText = document.getElementById('progressText');

    // State
    let currentCardIndex = 0;

    function updateCard() {
        if (flashcardData.length === 0) {
            termEl.textContent = 'No flashcards available for this topic.';
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            progressText.textContent = '0/0';
            return;
        }

        const currentData = flashcardData[currentCardIndex];
        termEl.textContent = currentData.term;
        definitionEl.textContent = currentData.definition;
        
        // Un-flip the card
        flashcard.classList.remove('flipped');
        
        // Update progress and button states
        progressText.textContent = `${currentCardIndex + 1}/${flashcardData.length}`;
        prevBtn.disabled = currentCardIndex === 0;
        nextBtn.disabled = currentCardIndex === flashcardData.length - 1;
    }

    // Event Listeners
    flashcard.addEventListener('click', () => flashcard.classList.toggle('flipped'));
    prevBtn.addEventListener('click', () => {
        if (currentCardIndex > 0) {
            currentCardIndex--;
            updateCard();
        }
    });
    nextBtn.addEventListener('click', () => {
        if (currentCardIndex < flashcardData.length - 1) {
            currentCardIndex++;
            updateCard();
        }
    });

    // Initialize first card
    updateCard();
});
</script>
</body>
</html>