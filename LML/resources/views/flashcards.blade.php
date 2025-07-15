<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcards</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f4f7f6; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        .title-bar { display: flex; justify-content: space-between; align-items: center; background-color: rgba(0, 0, 0, 0.5); padding: 10px 20px; color: white; flex-shrink: 0; }
        .title-bar-page-name { font-family: Arial, sans-serif; font-size: 1.2em; font-weight: bold; background-color: rgba(255, 255, 255, 0.2); padding: 8px 15px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.4); }
        .title-bar-close-btn { background: none; border: 1px solid transparent; color: white; cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: bold; border-radius: 6px; line-height: 1; transition: background-color 0.2s ease; }
        .title-bar-close-btn:hover { background-color: #d9534f; }
        .page-wrapper { padding: 2rem; display: flex; justify-content: center; align-items: center; flex-grow: 1; }
        .container { width: 100%; max-width: 600px; text-align: center; }
        h1 { color: #3b82f6; margin-bottom: 1.5rem; font-size: 2rem; font-weight: bold; }
        .flashcard-container { perspective: 1000px; margin-bottom: 1.5rem; }
        .flashcard { width: 100%; height: 300px; position: relative; transform-style: preserve-3d; transition: transform 0.6s; cursor: pointer; margin: 0 auto; }
        .flashcard.flipped { transform: rotateY(180deg); }
        .flashcard-front, .flashcard-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; display: flex; justify-content: center; align-items: center; padding: 2rem; box-sizing: border-box; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-size: 1.5rem; }
        .flashcard-front { background-color: #ffffff; color: #1e293b; border: 1px solid #e2e8f0; }
        .flashcard-back { background-color: #3b82f6; color: white; transform: rotateY(180deg); }
        .navigation-buttons { display: flex; justify-content: space-between; gap: 0.75rem; margin-top: 1.5rem; }
        button { padding: 0.75rem 1.5rem; border: none; border-radius: 0.25rem; background-color: #3b82f6; color: white; cursor: pointer; transition: background-color 0.2s; font-weight: 500; font-size: 1rem; }
        button:hover { background-color: #2563eb; }
        button:disabled { background-color: #9ca3af; cursor: not-allowed; }
        .progress-text { font-size: 1rem; color: #64748b; }
    </style>
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