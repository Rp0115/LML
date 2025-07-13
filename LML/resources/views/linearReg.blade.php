{{-- <!DOCTYPE html>
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
            min-height: 100vh;
            gap: 20px; /* Adds space between sidebar and main content */
            padding: 20px; /* Prevents sidebar from touching viewport edges */
        }
  
        .sidebar {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            width: 300px; /* Reduced from 200px */
            height: px;
            background: rgba(223, 223, 223, 0.3);
            padding: 15px 0; /* Less padding */
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

        /* Main Content Styling (Box Effect) */
       .main-content {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            flex: 1;
            padding: 15px; /* Less padding */
            background: rgba(223, 223, 223, 0.3);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            max-width: calc(100% - 180px); 
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
            font-size: clamp(16px, 2vw, 18px); /* Responsive font size */
            line-height: 1.8;
            color: #222;
            margin: 0 0 1.5em 0;
            /* max-width: 65ch; Optimal line length */
            text-align: justify;
            hyphens: auto;
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#" class = "horrible-font-4">Intro</a>
        <a href="#">JupyterNotebook</a>
        <a href="#">Flash</a>
        <a href="#">Quiz</a>
    </div>
    
    <div class="main-content">
        <h1 class = "water-effect" >Linear Regression</h1>
        <p class = "formatted-paragraph" style= "flex: 1; overflow-y: auto; margin: 20px; height: 100vh; padding: 15px; background: rgba(255, 255, 255, 0.8); font-family: 'Times New Roman', Times, serif; font-size: 20px;"> 
            Linear regression is a statistical method used to model the relationship between a dependent variable and one or more independent variables by fitting a linear equation to the observed data. It aims to find the "best-fit" line (or hyperplane in higher dimensions) that minimizes the difference between the predicted and actual values. This technique is widely used in various fields, including machine learning, statistics, and data analysis, for prediction, understanding relationships, and making inferences
Key Concepts:
Dependent Variable (Y): The variable being predicted or explained. 
Independent Variable(s) (X): The variable(s) used to predict or explain the dependent variable. 
Linear Equation: The equation of a line (y = mx + b in simple linear regression, or a more complex form in multiple linear regression) that represents the relationship between the variables. 
Best-fit Line: The line that minimizes the sum of squared differences between the predicted and actual values of the dependent variable. 
Slope (m): Indicates the change in the dependent variable for a one-unit change in the independent variable. 
Intercept (b): The value of the dependent variable when the independent variable is zero. 
Types of Linear Regression: 
Simple Linear Regression: Involves one independent variable and one dependent variable. 
Multiple Linear Regression: Involves two or more independent variables and one dependent variable. 
Applications:
Prediction:
Estimating future values of a dependent variable based on independent variables. 
Understanding Relationships:
Identifying the nature and strength of the relationship between variables. 
Causal Inference:
Investigating whether changes in one variable cause changes in another (though correlation does not imply causation). 
Feature Selection:
Determining which independent variables are most important in predicting the dependent variable. 
Example:
A simple linear regression model could be used to predict a student's final exam score (dependent variable) based on their midterm exam score (independent variable). The model would fit a line to the data points, and the equation of the line could be used to predict the final exam score for a student given their midterm score. 
In essence, linear regression provides a powerful tool for understanding and predicting the behavior of data by finding the best linear fit to the relationships between variables. </p>
    </div>
</body>
</html> --}}

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
            /* Changed layout to column to stack title bar on top */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            display: flex;
            flex-grow: 1; /* Allows this wrapper to fill available space */
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            width: 300px;
            flex-shrink: 0; /* Prevents sidebar from shrinking */
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

        .main-content {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            flex: 1;
            padding: 25px;
            background: rgba(235, 235, 235, 0.4);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
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
            text-align: justify;
        }
        
        /* ✨ New CSS for the Title Bar ✨ */
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            color: white;
            flex-shrink: 0; /* Prevents title bar from shrinking */
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
    </style>
</head>
<body>
    <div class="title-bar">
        <div class="title-bar-page-name" id="page-title-display">
            </div>
        <a href='{{ route('models') }}' style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">
                &times;
            </button>
        </a>
        
    </div>

    <div class="content-wrapper">
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
        // ✨ Get a reference to the new title display element
        const pageTitleDisplay = document.getElementById('page-title-display');

        const pageContent = {
            intro: {
                title: 'Introduction',
                body: `<p class="formatted-paragraph">
                    Linear regression is a statistical method used to model the relationship between a dependent variable and one or more independent variables by fitting a linear equation to the observed data. It aims to find the "best-fit" line (or hyperplane in higher dimensions) that minimizes the difference between the predicted and actual values. This technique is widely used in various fields, including machine learning, statistics, and data analysis, for prediction, understanding relationships, and making inferences
Key Concepts:
Dependent Variable (Y): The variable being predicted or explained. 
Independent Variable(s) (X): The variable(s) used to predict or explain the dependent variable. 
Linear Equation: The equation of a line (y = mx + b in simple linear regression, or a more complex form in multiple linear regression) that represents the relationship between the variables. 
Best-fit Line: The line that minimizes the sum of squared differences between the predicted and actual values of the dependent variable. 
Slope (m): Indicates the change in the dependent variable for a one-unit change in the independent variable. 
Intercept (b): The value of the dependent variable when the independent variable is zero. 
Types of Linear Regression: 
Simple Linear Regression: Involves one independent variable and one dependent variable. 
Multiple Linear Regression: Involves two or more independent variables and one dependent variable. 
Applications:
Prediction:
Estimating future values of a dependent variable based on independent variables. 
Understanding Relationships:
Identifying the nature and strength of the relationship between variables. 
Causal Inference:
Investigating whether changes in one variable cause changes in another (though correlation does not imply causation). 
Feature Selection:
Determining which independent variables are most important in predicting the dependent variable. 
Example:
A simple linear regression model could be used to predict a student's final exam score (dependent variable) based on their midterm exam score (independent variable). The model would fit a line to the data points, and the equation of the line could be used to predict the final exam score for a student given their midterm score. 
In essence, linear regression provides a powerful tool for understanding and predicting the behavior of data by finding the best linear fit to the relationships between variables. 
                    </p>` // Truncated for brevity
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

        function updateView(hash) {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.sidebar a[data-content-id="${hash}"]`);
            
            if (activeLink) {
                activeLink.classList.add('active');
                const content = pageContent[hash];

                // Update the main content
                mainContent.innerHTML = `
                    <h1 class="water-effect">${content.title}</h1>
                    ${content.body}
                `;

                // ✨ Update the title bar's text
                pageTitleDisplay.textContent = content.title;
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