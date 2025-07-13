<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>
    <style>
        body {
            background-image: url("/images/water.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
  
        /* Title bar styling */
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background: rgba(223, 223, 223, 0.5);*/
            padding: 5px 10px;
            /* border-radius: 8px 8px 0 0;
            border: 1px solid #e0e0e0;
            border-bottom: none; */ 
        }
        
        .app-title {
            font-family: "Papyrus", fantasy;
            font-size: 18px;
            color: #333;
            padding-left: 10px;
        }
        
          /* Desktop-style window controls */
        .window-controls {
            display: flex;
            gap: 5px;
        }
        
        .window-btn {
            width: 30px;
            height: 25px;
            /* border-radius: 4px; */
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s;
        }

        .close-btn {
            background: rgb(163, 0, 0);
            color:white;
        }
        
        .window-btn:hover {
            filter: brightness(1.2);
        }
        
        .close-btn:hover {
            background: rgba(211, 0, 0, 0.8);
            color: white;
        }
        
        .app-container {
            display: flex;
            flex: 1;
            gap: 20px;
            padding: 0 20px 20px 20px;
            position: relative;
        }

        .sidebar {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            width: 300px;
            background: rgba(223, 223, 223, 0.3);
            padding: 15px 0;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            border-top: none;
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
            background: rgba(0, 102, 255, 0.6);
            color: #ffffff;
        }

        .main-content {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            flex: 1;
            padding: 15px;
            background: rgba(223, 223, 223, 0.3);
            border-radius: 0 0 8px 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            border-top: none;
        }

        h1 {
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
            margin: 0 0 1.5em 0;
            text-align: justify;
            hyphens: auto;
        }
    </style>
</head>
<body>
    <div class="title-bar">
        <div class="app-title"></div>
        <div class="window-controls">
            <button class="window-btn close-btn" title="Close">×</button>
        </div>
    </div>
    
    <div class="app-container">
        <div class="sidebar">
            <a href="#" data-content-id="intro">Intro</a>
            <a href="#" data-content-id="jupyter">JupyterNotebook</a>
            <a href="#" data-content-id="flash">Flash</a>
            <a href="#" data-content-id="quiz">Quiz</a>
        </div>
        
        <div class="main-content">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            const mainContent = document.querySelector('.main-content');

            const pageContent = {
                intro: {
                    title: 'Introduction',
                    body: `
                        <p class="formatted-paragraph">
                            This is the introduction to our topic on machine learning. Here we will cover the fundamental concepts and prepare you for the more advanced sections.
                        </p>
                        <p class="formatted-paragraph">
                            Linear regression is a statistical method used to model the relationship between a dependent variable and one or more independent variables by fitting a linear equation to the observed data.
                        </p>`
                },
                jupyter: {
                    title: 'JupyterNotebook',
                    body: '<p class="formatted-paragraph">Here is the embedded Jupyter Notebook content. You can run code and see visualizations directly in this section.</p>'
                },
                flash: {
                    title: 'Flash Cards',
                    body: '<p class="formatted-paragraph">Test your knowledge with these interactive flash cards! Click a card to see the answer.</p>'
                },
                quiz: {
                    title: 'Final Quiz',
                    body: '<p class="formatted-paragraph">Ready to test your understanding? Take the final quiz to see how much you have learned.</p>'
                }
            };

           
            document.querySelector('.close-btn').addEventListener('click', function() {
                
                document.body.style.opacity = '0';
                setTimeout(() => {
                    window.close(); 
                }, 300);
            });

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
                }
            }

            sidebarLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const contentId = event.target.dataset.contentId;
                    updateView(contentId);
                });
            });

            updateView('intro');
        });
    </script>
</body>
</html>