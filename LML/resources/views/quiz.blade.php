<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Quiz</title>
    <link rel="stylesheet" href="{{asset('css/quizstyle.css')}}">
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