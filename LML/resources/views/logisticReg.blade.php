<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Logistic Regression</title>
    <link rel="stylesheet" href="{{ asset('css/logisticRegstyle.css') }}">
</head>
<body>
    <div class="title-bar">
        <div class="title-bar-page-name" id="page-title-display"></div>
        <a href="{{ url('/models') }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="content-wrapper">
        <div class="sidebar">
            <a href="#" data-content-id="intro">
                <span>Intro</span>
            </a>
            <a href="#" data-content-id="jupyter">
                <span>Saturn</span>
                <img src="{{ asset('images/saturn.png') }}" class="sidebar-icon" alt="Jupyter">
            </a>
            <a href="#" data-content-id="flash">
                <span>Flash</span>
                <img src="{{ asset('images/FlashQT.png') }}" class="sidebar-icon" alt="Flash">
            </a>
            <a href="#" data-content-id="quiz">
                <span>Quiz</span>
                <img src="{{ asset('images/Quiz.png') }}" class="sidebar-icon" alt="Quiz">
            </a>
            <a href="#" data-content-id="notes">
                <span>Notes</span>
            </a>
        </div>
        
        <div class="main-content">
            </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        const mainContent = document.querySelector('.main-content');
        const pageTitleDisplay = document.getElementById('page-title-display');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // 1. Store the pre-loaded note content from the controller
        let noteContent = @json($noteContent);

        // This page's specific topic ID
        const topicId = 'logisticReg';

        const pageContent = {
            intro: { title: 'Introduction', body: `<p class="formatted-paragraph">
                Logistic regression is a statistical method used for binary classification problems, 
                where the goal is to predict one of two possible outcomes. The core idea is to model the probability that a 
                given input belongs to a particular class. Unlike linear regression which fits a straight line, logistic regression uses the 
                logistic function (or sigmoid function) to transform its output into an S-shaped curve. This ensures the output is always a 
                probability between 0 and 1. The primary goal is to find the model parameters that maximize the likelihood of the observed data, 
                a method known as Maximum Likelihood Estimation. By identifying the best-fitting S-curve, logistic regression can classify new data 
                and provide clear insights into how independent variables influence the probability of the outcome, making it a foundational algorithm 
                for classification tasks.
                </p>` },
            jupyter: { title: 'Saturn Notebook', body: `<iframe src="{{ asset('jupyter/ml-logistic-regression.html') }}" width="100%" height="775"></iframe>` },
            flash: { title: 'Flash Cards', body: `<p class="formatted-paragraph">Practice your knowledge. Do these flashcards to test your understanding.</p><a href="{{ route('flashcards.show', ['setId' => 'logisticReg']) }}" class="button-link">Go to Flashcards</a>` },
            quiz: { title: 'Final Quiz', body: `<p class="formatted-paragraph">Take the quiz</p><a href="{{ route('quiz.show', ['quizId' => 'logisticReg']) }}" class="button-link">Go to Quiz</a>` },
            notes: {
                title: 'Notes for Logistic Regression',
                body: `<textarea id="notes-area" placeholder="Start typing..."></textarea><button id="save-notes-btn">Save Notes</button>`
            }
        };
        
        // 2. The loadNotes function is now instant. No network request needed.
        function loadNotes() {
            const notesArea = document.getElementById('notes-area');
            if (notesArea) {
                // It just uses the pre-loaded data from our variable.
                notesArea.value = noteContent;
            }
        }

        async function saveNotes() {
            const notesArea = document.getElementById('notes-area');
            if (!notesArea) return;

            const currentText = notesArea.value;
            try {
                const response = await fetch('/notes', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ id: topicId, content: currentText })
                });

                if (response.ok) {
                    // 3. After saving, update our local variable.
                    // This keeps the pre-loaded data in sync without another fetch.
                    noteContent = currentText;
                    alert('Notes saved successfully!');
                } else {
                    const result = await response.json();
                    alert('Error saving notes: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error saving notes:', error);
                alert('Could not save notes.');
            }
        }

        function updateView(hash) {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.sidebar a[data-content-id="${hash}"]`);
            
            if (activeLink) {
                activeLink.classList.add('active');
                const content = pageContent[hash];
                mainContent.innerHTML = `<h1 class="water-effect">${content.title}</h1>${content.body}`;
                pageTitleDisplay.textContent = content.title;

                if (hash === 'notes') {
                    loadNotes(); // This is now instantaneous
                    document.getElementById('save-notes-btn').addEventListener('click', saveNotes);
                }
            }
        }

        sidebarLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                updateView(event.currentTarget.dataset.contentId);
            });
        });

        // Your default view is still 'intro'
        updateView('intro');
    });
</script>

</body>
</html>