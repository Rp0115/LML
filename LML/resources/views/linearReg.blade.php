<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Linear Regression</title>
    <link rel="stylesheet" href="{{ asset('css/linearRegstyle.css') }}">
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
        const topicId = 'linearReg';

        const pageContent = {
            intro: {
                title: 'Introduction',
                body: `<p class="formatted-paragraph">
                    Linear regression is a statistical method used to model the relationship between a dependent variable 
                    and one or more independent variables by fitting a linear equation to the observed data. The core idea 
                    is to find a straight line, known as the regression line, that best represents the data points. The primary goal 
                    is to minimize the total error between the predicted values from the line and the actual data points. This is typically 
                    achieved by minimizing the sum of the squared differences, often called residuals. By identifying this "best-fit" line, 
                    linear regression allows for the prediction of future outcomes and provides clear insights into how the independent variables 
                    influence the dependent variable. It remains a foundational algorithm in both statistics and machine learning due to its 
                    simplicity and interpretability.
                    </p>`
            },
            jupyter: {
                title: 'Saturn Notebook',
                body: `<iframe src={{asset("jupyter/Ch03_linreg_lab.html")}} width="100%" height="775"></iframe>`
            },
            flash: {
                title: 'Flash Cards',
                body: `
                        <p class="formatted-paragraph">
                            Practice your knowledge. Do these flashcards to test your understanding.
                        </p>
                        <a href="{{ route('flashcards.show', ['setId' => 'linearReg']) }}" class="button-link">
                            Go to Flashcards
                        </a>
                    `
            },
            quiz: {
                title: 'Final Quiz',
                body: `
                            <p class="formatted-paragraph">
                                Take the quiz
                            </p>
                            <a href="{{ route('quiz.show', ['quizId' => 'linearReg']) }}" class="button-link">Go to Quiz</a>
                                
                            </a>
                        `
            },
            notes: {
                title: 'Notes for Linear Regression',
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