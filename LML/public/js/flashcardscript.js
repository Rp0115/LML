document.addEventListener("DOMContentLoaded", function () {
    const flashcardElement = document.getElementById("flashcard");
    const flashcardInnerElement = document.getElementById("flashcardInner");
    const questionElement = document.getElementById("term");
    const answerElement = document.getElementById("definition");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const flipBtn = document.getElementById("flipBtn");
    const progressBar = document.getElementById("progressBar");
    const progressText = document.getElementById("progressText");
    const completionMessage = document.getElementById("completionMessage");
    const restartBtn = document.getElementById("restartBtn");
    const difficultyButtons = document.querySelectorAll(".difficulty-btn");

    const flashcards = [
        {
            term: "Bias",
            definition:
                "The error introduced by approximating a real-world problem with a simplified model.",
        },
        {
            term: "Variance",
            definition:
                "The amount that the predicted value would change if we estimated it using a different training dataset.",
        },
        {
            term: "Overfitting",
            definition:
                "When a model learns the training data too well, including its noise and outliers, resulting in poor performance on new data.",
        },
    ];

    let currentCardIndex = 0;
    let isFlipped = false;
    let totalCards = flashcards.length;

    function init() {
        updateProgress();
        displayCard();
        updateNavigationButtons();
        // Hide completion message on init
        completionMessage.style.display = "none";
        // Show main content
        document.querySelector(".flashcard-container").style.display = "block";
        document.querySelector(".navigation-buttons").style.display = "flex";
        document.querySelector(".difficulty-buttons").style.display = "flex";
        document.getElementById("flipBtn").style.display = "block";
        document.querySelector(".progress-container").style.display = "block";
        document.querySelector("#progressText").style.display = "block";
    }

    function displayCard() {
        const card = flashcards[currentCardIndex];
        questionElement.textContent = card.term;
        answerElement.textContent = card.definition;

        if (isFlipped) {
            flashcardElement.classList.remove("flipped");
            isFlipped = false;
        }
    }

    function updateProgress() {
        const progress = ((currentCardIndex + 1) / totalCards) * 100;
        progressBar.style.width = `${progress}%`;
        progressText.textContent = `${currentCardIndex + 1}/${totalCards}`;
    }

    function updateNavigationButtons() {
        prevBtn.disabled = currentCardIndex === 0;
        // The next button's primary function is now handled by difficulty buttons
        nextBtn.style.display = "none"; // Or manage its state differently
    }

    function flipCard() {
        isFlipped = !isFlipped;
        flashcardElement.classList.toggle("flipped");
    }

    function showCompletionMessage() {
        document.querySelector(".flashcard-container").style.display = "none";
        document.querySelector(".navigation-buttons").style.display = "none";
        document.querySelector(".difficulty-buttons").style.display = "none";
        document.getElementById("flipBtn").style.display = "none";
        document.querySelector(".progress-container").style.display = "none";
        document.querySelector("#progressText").style.display = "none";
        completionMessage.style.display = "block";
    }

    function handleNextCard() {
        if (currentCardIndex < totalCards - 1) {
            currentCardIndex++;
            displayCard();
            updateProgress();
            updateNavigationButtons();
        } else {
            showCompletionMessage();
        }
    }

    flashcardElement.addEventListener("click", flipCard);
    flipBtn.addEventListener("click", flipCard);

    prevBtn.addEventListener("click", function () {
        if (currentCardIndex > 0) {
            currentCardIndex--;
            displayCard();
            updateProgress();
            updateNavigationButtons();
        }
    });

    // The "Next" button can be repurposed or used as a fallback
    nextBtn.addEventListener("click", handleNextCard);

    difficultyButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Here you could add logic based on difficulty
            // For now, it just moves to the next card
            handleNextCard();
        });
    });

    restartBtn.addEventListener("click", function () {
        currentCardIndex = 0;
        isFlipped = false;
        init();
    });

    init();
});
