{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Linear Regression</title>
    <style>
        /* Body and Layout */
        body {
            background-image: url("{{ asset('images/water.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            display: flex;
            flex-grow: 1;
            padding: 20px;
            gap: 20px;
        }

        /* Title Bar */
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            color: white;
            flex-shrink: 0;
        }
        
        .title-bar-page-name {
            font-family: Arial, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .title-bar-close-btn {
            background: none;
            border: 1px solid transparent;
            color: white;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            border-radius: 6px;
            line-height: 1;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .title-bar-close-btn:hover {
            background-color: #d9534f;
            color: #ffffff;
        }

        /* Sidebar */
        .sidebar {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            width: 300px;
            flex-shrink: 0;
            background: rgba(223, 223, 223, 0.3);
            padding: 15px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            font-size: 30px;
        }

        .sidebar a {
            display: block;
            color: #0f0f0f;
            padding: 15px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: rgba(0, 102, 255, 0.4); 
            color: #ffffff;
        }

        .sidebar a.active {
            background: rgba(0, 82, 204, 0.6);
            color: #ffffff;
            font-weight: bold;
        }

        /* Main Content Area */
        .main-content {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            flex: 1;
            padding: 25px;
            background: rgba(235, 235, 235, 0.4);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        .main-content h1 {
            color: #2c3e50;
            margin-top: 0;
        }

        .water-effect {
            font-size: 3rem;
            background: linear-gradient(90deg, #00d4ff, #0066ff, #00d4ff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .formatted-paragraph {
            font-family: 'Georgia', serif;
            font-size: clamp(16px, 2vw, 18px);
            line-height: 1.8;
            color: #222;
            text-align: justify;
        }

        /* Notes Section Specific Styles */
        .main-content textarea {
            flex-grow: 1;
            width: 98%;
            min-height: 400px;
            padding: 10px;
            font-family: 'Georgia', serif;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 15px;
            resize: vertical;
        }

        .main-content button {
            padding: 10px 20px;
            margin-top: 15px;
            cursor: pointer;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            align-self: flex-start;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="title-bar">
        <div class="title-bar-page-name" id="page-title-display"></div>
        <a href="{{ url('/models') }}" style="text-decoration: none;"> <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="content-wrapper">
        <div class="sidebar">
            <a href="#" data-content-id="intro">Intro</a>
            <a href="#" data-content-id="jupyter">JupyterNotebook</a>
            <a href="#" data-content-id="flash">Flash</a>
            <a href="#" data-content-id="quiz">Quiz</a>
            <a href="#" data-content-id="notes">Notes</a>
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

        // Defines the content for each sidebar link
        const pageContent = {
            intro: {
                title: 'Introduction',
                body: `<p class="formatted-paragraph">
                        Linear regression is a statistical method used to model the relationship between a dependent variable and one or more independent variables by fitting a linear equation to the observed data. It aims to find the "best-fit" line (or hyperplane in higher dimensions) that minimizes the difference between the predicted and actual values.
                       </p>`
            },
            jupyter: {
                title: 'JupyterNotebook',
                body: `<p class="formatted-paragraph">Here is the embedded Jupyter Notebook content. You can run code and see visualizations directly in this section.</p>`
            },
            flash: {
                title: 'Flash Cards',
                body: `<p class="formatted-paragraph">Test your knowledge with these interactive flash cards! Click a card to see the answer.</p>`
            },
            quiz: {
                title: 'Final Quiz',
                body: `<p class="formatted-paragraph">Ready to test your understanding? Take the final quiz to see how much you have learned.</p>`
            },
            notes: {
                title: 'My Notes',
                body: `
                    <textarea id="notes-area" placeholder="Start typing your notes here..."></textarea>
                    <button id="save-notes-btn">Save Notes</button>
                `
            }
        };

        // Fetches notes from the database via the API
        async function loadNotes() {
            try {
                // NOTE: Use '/notes/linearReg' if you put the route in web.php
                const response = await fetch('/notes/linearReg'); 
                const data = await response.json();
                const notesArea = document.getElementById('notes-area');
                if (notesArea) {
                    notesArea.value = data.content;
                }
            } catch (error) {
                console.error('Error loading notes:', error);
                alert('Could not load notes. Check the browser console for details.');
            }
        }

        // Saves notes to the database via the API
        async function saveNotes() {
            const notesArea = document.getElementById('notes-area');
            if (!notesArea) return;

            const content = notesArea.value;
            try {
                // NOTE: Use '/notes' if you put the route in web.php
                const response = await fetch('/notes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id: 'linearReg',
                        content: content
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Notes saved successfully!');
                } else {
                    alert('Error saving notes: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error saving notes:', error);
                alert('Could not save notes. Check the browser console and server logs.');
            }
        }

        // Main function to update the view based on the clicked link
        function updateView(hash) {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.sidebar a[data-content-id="${hash}"]`);
            
            if (activeLink) {
                activeLink.classList.add('active');
                const content = pageContent[hash];

                mainContent.innerHTML = `
                    <h1 class="water-effect">${content.title}</h1>
                    ${content.body}
                `;
                pageTitleDisplay.textContent = content.title;

                // If the notes tab is active, load the notes and set up the save button
                if (hash === 'notes') {
                    loadNotes();
                    const saveBtn = document.getElementById('save-notes-btn');
                    if(saveBtn) {
                        saveBtn.addEventListener('click', saveNotes);
                    }
                }
            }
        }

        // Add click event listeners to all sidebar links
        sidebarLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Stop the link from navigating
                const contentId = event.target.dataset.contentId;
                updateView(contentId);
            });
        });

        // Load the 'Intro' section by default when the page loads
        updateView('intro');
    });
</script>

</body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Linear Regression</title>
    <link rel="stylesheet" href='{{asset("css/linearRegstyle.css")}}'>
</head>
<body>

    <div class="title-bar">
        <div class="title-bar-page-name" id="page-title-display"></div>
        <a href="{{ url('/models') }}" style="text-decoration: none;"> <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="content-wrapper">
        <div class="sidebar">
            <a href="#" data-content-id="intro">Intro</a>
            <a href="#" data-content-id="jupyter">JupyterNotebook</a>
            <a href="#" data-content-id="flash">Flash</a>
            <a href="#" data-content-id="quiz">Quiz</a>
            <a href="#" data-content-id="notes">Notes</a>
        </div>
        
        <div class="main-content">
            </div>
    </div>

<script src='{{asset("js/linearRegscript.js")}}'></script>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Linear Regression</title>
    <style>
        /* Body and Layout */
        body {
            background-image: url("{{ asset('images/water.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            display: flex;
            flex-grow: 1;
            padding: 20px;
            gap: 20px;
        }

        /* Title Bar */
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            color: white;
            flex-shrink: 0;
        }

        .title-bar-page-name {
            font-family: Arial, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .title-bar-close-btn {
            background: none;
            border: 1px solid transparent;
            color: white;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            border-radius: 6px;
            line-height: 1;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .title-bar-close-btn:hover {
            background-color: #d9534f;
            color: #ffffff;
        }

        /* Sidebar */
        .sidebar {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            width: 300px;
            flex-shrink: 0;
            background: rgba(223, 223, 223, 0.3);
            padding: 15px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            font-size: 30px;
        }

        /* ✅ Updated Sidebar Link Style */
        .sidebar a {
            display: flex; /* Use flexbox for alignment */
            justify-content: space-between; /* Pushes text and icon apart */
            align-items: center; /* Vertically centers them */
            color: #0f0f0f;
            padding: 15px;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        /* ✅ New Style for the Icon */
        .sidebar-icon {
            width: 70px; /* Adjust size as needed */
            height: 70px;
            opacity: 0.7; /* Optional: makes icon less prominent */
        }

        .sidebar a:hover {
            background: rgba(0, 102, 255, 0.4);
            color: #ffffff;
        }

        .sidebar a.active {
            background: rgba(0, 82, 204, 0.6);
            color: #ffffff;
            font-weight: bold;
        }

        /* Main Content Area Styles... */
        .main-content {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            flex: 1;
            padding: 25px;
            background: rgba(235, 235, 235, 0.4);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }
        .main-content h1 {
            color: #2c3e50;
            margin-top: 0;
        }
        .water-effect {
            font-size: 3rem;
            background: linear-gradient(90deg, #00d4ff, #0066ff, #00d4ff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer {
            to { background-position: 200% center; }
        }
        .formatted-paragraph {
            font-family: 'Georgia', serif;
            font-size: clamp(16px, 2vw, 18px);
            line-height: 1.8;
            color: #222;
            text-align: justify;
        }
        .main-content textarea {
            flex-grow: 1;
            width: 98%;
            min-height: 400px;
            padding: 10px;
            font-family: 'Georgia', serif;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 15px;
            resize: vertical;
        }
        .main-content button {
            padding: 10px 20px;
            margin-top: 15px;
            cursor: pointer;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            align-self: flex-start;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
        /* Add this with your other styles */
.button-link {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 15px;
    cursor: pointer;
    background-color: #10b981; /* Green color */
    color: white;
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    font-family: Arial, sans-serif;
    font-size: 16px;
    transition: background-color 0.2s;
}

.button-link:hover {
    background-color: #059669;
}
    </style>
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
                {{-- <img src="{{ asset('images/intro-icon.png') }}" class="sidebar-icon" alt="Intro"> --}}
            </a>
            <a href="#" data-content-id="jupyter">
                <span>Notebook</span>
                <img src="{{ asset('images/notebook.png') }}" class="sidebar-icon" alt="Jupyter">
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
                {{-- <img src="{{ asset('images/notes-icon.png') }}" class="sidebar-icon" alt="Notes"> --}}
            </a>
        </div>
        
        <div class="main-content">
            </div>
    </div>

<script>
    // Your existing JavaScript code...
    // No changes are needed in the script.
    document.addEventListener('DOMContentLoaded', () => {

        const sidebarLinks = document.querySelectorAll('.sidebar a');
        const mainContent = document.querySelector('.main-content');
        const pageTitleDisplay = document.getElementById('page-title-display');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const pageContent = {
            intro: {
                title: 'Introduction',
                body: `<p class="formatted-paragraph">Linear regression is a statistical method...</p>`
            },
            jupyter: {
                title: 'Notebook',
                // body: `<p class="formatted-paragraph">Here is the embedded Jupyter Notebook content...</p>`
                body: `<iframe src={{asset("jupyter/Ch03_linreg_lab.html")}} width="100%" height="775"></iframe>`
            },
            flash: {
                title: 'Flash Cards',
                // body: `<p class="formatted-paragraph">Test your knowledge with these interactive flash cards!</p>`
                body: `
                        <p class="formatted-paragraph">
                            Practice your knowledge. Do these flashcards to test your understanding.
                        </p>
                        <a href="{{ route('flashcards') }}" class="button-link">
                            Go to Flashcards
                        </a>
                    `
            },
            quiz: {
                title: 'Final Quiz',
                // body: `<p class="formatted-paragraph">Ready to test your understanding? Take the final quiz.</p>`
                body: `
                            <p class="formatted-paragraph">
                                Take the quiz
                            </p>
                            <a href="{{ route('quiz') }}" class="button-link">
                                Go to Quiz
                            </a>
                        `
            },
            notes: {
                title: 'My Notes',
                body: `
                    <textarea id="notes-area" placeholder="Start typing your notes here..."></textarea>
                    <button id="save-notes-btn">Save Notes</button>
                `
            }
        };

        async function loadNotes() {
            try {
                const response = await fetch('/notes/linearReg');
                const data = await response.json();
                const notesArea = document.getElementById('notes-area');
                if (notesArea) {
                    notesArea.value = data.content;
                }
            } catch (error) {
                console.error('Error loading notes:', error);
                alert('Could not load notes. Check the browser console for details.');
            }
        }

        async function saveNotes() {
            const notesArea = document.getElementById('notes-area');
            if (!notesArea) return;

            const content = notesArea.value;
            try {
                const response = await fetch('/notes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id: 'linearReg',
                        content: content
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Notes saved successfully!');
                } else {
                    alert('Error saving notes: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error saving notes:', error);
                alert('Could not save notes. Check the browser console and server logs.');
            }
        }

        function updateView(hash) {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.sidebar a[data-content-id="${hash}"]`);
            
            if (activeLink) {
                activeLink.classList.add('active');
                const content = pageContent[hash];

                mainContent.innerHTML = `
                    <h1 class="water-effect">${content.title}</h1>
                    ${content.body}
                `;
                pageTitleDisplay.textContent = content.title;

                if (hash === 'notes') {
                    loadNotes();
                    const saveBtn = document.getElementById('save-notes-btn');
                    if(saveBtn) {
                        saveBtn.addEventListener('click', saveNotes);
                    }
                }
            }
        }

        sidebarLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const contentId = event.currentTarget.dataset.contentId; // Use currentTarget
                updateView(contentId);
            });
        });

        updateView('intro');
    });
</script>

</body>
</html>