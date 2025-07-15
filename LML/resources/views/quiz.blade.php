{{-- <x-app-layout>
    <link rel="stylesheet" href='{{asset("css/quizstyle.css")}}'>
    
    
    <div class="quiz-wrapper">
            <div class="window-controls">
                <a href="{{ route('desktop') }}">
                    <button class="window-btn close-btn" title="Close">×</button>
                </a>
            </div>
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
</div>
    <script src='{{ asset("js/quizscript.js") }}'></script>
</x-app-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Quiz</title>
    <style>
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            background: #f4f7f6; 
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Title Bar Styles */
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
            transition: background-color 0.2s ease;
        }
        .title-bar-close-btn:hover {
            background-color: #d9534f;
        }

        /* Main Quiz Container */
        .page-wrapper {
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-grow: 1;
        }
        .quiz-container { 
            width: 100%;
            max-width: 800px; 
            background: white; 
            padding: 2rem; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        .question-block { 
            margin-bottom: 1.5rem; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 1.5rem; 
        }
        .question-block:last-of-type { 
            border-bottom: none; 
            margin-bottom: 2rem;
        }
        h1 { 
            text-align: center; 
            color: #333; 
            margin-bottom: 2rem;
        }
        h2 { 
            font-size: 1.2rem; 
            color: #555; 
            margin-bottom: 1rem; 
            font-weight: 600;
        }
        .options label { 
            display: block; 
            background: #f9f9f9; 
            padding: 0.8rem; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            margin-bottom: 0.5rem; 
            cursor: pointer; 
            transition: background 0.2s, border-color 0.2s; 
        }
        .options label:hover { 
            background: #e9e9e9; 
            border-color: #ccc;
        }
        .options input { 
            margin-right: 10px; 
            accent-color: #3b82f6;
        }
        .submit-btn { 
            display: block; 
            width: 100%; 
            padding: 1rem; 
            background: #3b82f6; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            font-size: 1.2rem; 
            cursor: pointer; 
            transition: background-color 0.2s;
        }
        .submit-btn:hover { 
            background: #2563eb; 
        }
        .status-message { 
            text-align: center; 
            padding: 1rem; 
            background: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
            border-radius: 5px; 
            margin-bottom: 1rem; 
            font-size: 1.2rem; 
            font-weight: bold; 
        }
        .last-score-message { 
            text-align: center; 
            padding: 0.8rem; 
            background: #e2e8f0; 
            color: #4a5568; 
            border-radius: 5px; 
            margin-bottom: 2rem; 
            font-size: 1rem; 
        }
    </style>
</head>
<body>

    <div class="title-bar">
        <div class="title-bar-page-name">
            Knowledge Quiz
        </div>
        <a href="{{ $backRoute }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="page-wrapper">
        <div class="quiz-container">
            <h1>Knowledge Quiz</h1>

            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif
            
            @if (isset($lastScore) && !session('status'))
                <div class="last-score-message">
                    Your last score on this quiz was: <strong>{{ $lastScore }}%</strong>
                </div>
            @endif
            
            <form action="{{ route('quiz.store', ['quizId' => $quizId]) }}" method="POST">
                @csrf
                
                @foreach ($questions as $id => $question)
                    <div class="question-block">
                        <h2>{{ $loop->iteration }}. {{ $question['question'] }}</h2>
                        <div class="options">
                            @foreach ($question['options'] as $option)
                                <label>
                                    <input type="radio" name="answers[{{ $id }}]" value="{{ $option }}" required>
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="submit-btn">Submit Quiz</button>
            </form>
        </div>
    </div>

</body>
</html>