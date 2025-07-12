document.addEventListener("DOMContentLoaded", () => {
    // -------------------------------------------------------------------
    // --- TEMPLATE: MANUALLY INSERT YOUR QUESTIONS AND ANSWERS HERE ---
    // -------------------------------------------------------------------
    const quizData = [
        {
            question: "What is the capital of Japan?",
            answers: [
                { text: "Beijing", correct: false },
                { text: "Seoul", correct: false },
                { text: "Tokyo", correct: true },
                { text: "Bangkok", correct: false },
            ],
        },
        {
            question: "Which of these is a JavaScript framework?",
            answers: [
                { text: "Laravel", correct: false },
                { text: "React", correct: true },
                { text: "Django", correct: false },
                { text: "Flask", correct: false },
            ],
        },
        // --- Add Question 3 through 10 here in the same format ---
        {
            question: "Question 3",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: true },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 4",
            answers: [
                { text: "Choice A", correct: true },
                { text: "Choice B", correct: false },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 5",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: false },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: true },
            ],
        },
        {
            question: "Question 6",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: true },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 7",
            answers: [
                { text: "Choice A", correct: true },
                { text: "Choice B", correct: false },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 8",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: false },
                { text: "Choice C", correct: true },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 9",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: false },
                { text: "Choice C", correct: true },
                { text: "Choice D", correct: false },
            ],
        },
        {
            question: "Question 10",
            answers: [
                { text: "Choice A", correct: false },
                { text: "Choice B", correct: true },
                { text: "Choice C", correct: false },
                { text: "Choice D", correct: false },
            ],
        },
    ];
    // -------------------------------------------------------------------

    const questionContainer = document.getElementById("question-container");
    const questionTextElement = document.getElementById("question-text");
    const questionNumberElement = document.getElementById("question-number");
    const answerButtonsElement = document.getElementById("answer-buttons");
    const nextButton = document.getElementById("next-btn");
    const resultsContainer = document.getElementById("results-container");
    const scoreTextElement = document.getElementById("score-text");
    const restartButton = document.getElementById("restart-btn");

    let currentQuestionIndex = 0;
    let score = 0;

    function startQuiz() {
        currentQuestionIndex = 0;
        score = 0;
        nextButton.innerHTML = "Next";
        resultsContainer.style.display = "none";
        questionContainer.style.display = "block";
        showQuestion();
    }

    function showQuestion() {
        resetState();
        const currentQuestion = quizData[currentQuestionIndex];
        questionNumberElement.innerText = currentQuestionIndex + 1;
        questionTextElement.innerText = currentQuestion.question;

        currentQuestion.answers.forEach((answer) => {
            const button = document.createElement("button");
            button.innerText = answer.text;
            button.classList.add("btn");
            if (answer.correct) {
                button.dataset.correct = answer.correct;
            }
            button.addEventListener("click", selectAnswer);
            answerButtonsElement.appendChild(button);
        });
    }

    function resetState() {
        nextButton.style.display = "none";
        while (answerButtonsElement.firstChild) {
            answerButtonsElement.removeChild(answerButtonsElement.firstChild);
        }
    }

    function selectAnswer(e) {
        const selectedButton = e.target;
        const isCorrect = selectedButton.dataset.correct === "true";

        if (isCorrect) {
            score++;
            selectedButton.classList.add("correct");
        } else {
            selectedButton.classList.add("incorrect");
        }

        // Show correct answer if wrong one is selected
        Array.from(answerButtonsElement.children).forEach((button) => {
            if (button.dataset.correct === "true") {
                button.classList.add("correct");
            }
            button.disabled = true; // Disable all buttons after a choice is made
        });

        // Show the next button
        if (quizData.length > currentQuestionIndex + 1) {
            nextButton.style.display = "block";
        } else {
            nextButton.innerText = "Show Results";
            nextButton.style.display = "block";
        }
    }

    function showResults() {
        questionContainer.style.display = "none";
        resultsContainer.style.display = "block";
        scoreTextElement.innerText = `You scored ${score} out of ${quizData.length}!`;
    }

    nextButton.addEventListener("click", () => {
        if (quizData.length > currentQuestionIndex + 1) {
            currentQuestionIndex++;
            showQuestion();
        } else {
            showResults();
        }
    });

    restartButton.addEventListener("click", startQuiz);

    // Initial start of the quiz
    startQuiz();
});
