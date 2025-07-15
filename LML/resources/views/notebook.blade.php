<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/notebookstyle.css')}}">
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans flex flex-col min-h-screen">

    {{-- ✅ Correct Title Bar HTML --}}
    <div class="title-bar">
        <div class="title-bar-page-name">
            My Notebook
        </div>
        <a href="{{ url('/desktop') }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    {{-- Main Page Content --}}
    <div class="flex-grow container mx-auto p-4 sm:p-6 lg:p-8 max-w-4xl">
        <header class="text-center mb-8">
            <h1 class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 bg-clip-text text-transparent">
                My Notebook
            </h1>
            <p class="text-md text-gray-500 dark:text-gray-400 mt-2">All your notes, organized in one place.</p>
        </header>
        
        @if (session('status'))
            <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ session('status') }}
            </div>
        @endif

        {{-- Tab Buttons --}}
        <div id="units" class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-6">
            <button data-target="unit1" data-id="linearReg" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Linear Regression</button>
            <button data-target="unit2" data-id="logisticReg" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Logistic Regression</button>
            <button data-target="unit3" data-id="decisionTree" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Decision Tree</button>
            <button data-target="unit4" data-id="neuralNetwork" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Neural Network</button>
        </div>
        
        <form action="{{ route('notebook.store') }}" method="POST">
            @csrf
            <div id="notepad-container" class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl shadow-gray-500/10 dark:shadow-blue-500/10 p-1">
                <textarea name="unit1Notes" id="unit1" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Notes for Linear Regression...">{{ $notes['linearReg'] ?? '' }}</textarea>
                <textarea name="unit2Notes" id="unit2" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none" placeholder="Notes for Logistic Regression...">{{ $notes['logisticReg'] ?? '' }}</textarea>
                <textarea name="unit3Notes" id="unit3" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-purple-500 resize-none" placeholder="Notes for Decision Tree...">{{ $notes['decisionTree'] ?? '' }}</textarea>
                <textarea name="unit4Notes" id="unit4" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-pink-500 resize-none" placeholder="Notes for Neural Network...">{{ $notes['neuralNetwork'] ?? '' }}</textarea>
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-12 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 ease-in-out transform hover:-translate-y-1">
                    Save All Notes
                </button>
            </div>
        </form>
    </div>

    <script src="{{asset('js/notebookscript.js')}}"></script>
</body>
</html>