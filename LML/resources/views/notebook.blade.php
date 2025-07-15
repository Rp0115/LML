<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notebooks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        .notepad { display: none; }
        .notepad.active { display: block; }

     
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
       
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans flex flex-col min-h-screen">

    
    <div class="title-bar">
        <div class="title-bar-page-name">
            Notebooks
        </div>
        <a href="{{ url('/desktop') }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

 
    <div class="flex-grow container mx-auto p-4 sm:p-6 lg:p-8 max-w-4xl">
        <header class="text-center mb-8">
            <h1 class="text-4xl sm:text-5xl font-monospace bg-gradient-to-r from-pink-300 via-pink-500 to-purple-600 bg-clip-text text-transparent">
                Units
            </h1>
            <p class="text-md text-gray-500 dark:text-gray-400 mt-2"></p>
        </header>
        
        @if (session('status'))
            <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ session('status') }}
            </div>
        @endif

        <div id="units" class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-6">
            <button data-target="unit1" data-id="linearReg" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Linear Regression</button>
            <button data-target="unit2" data-id="logisticReg" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Logistic Regression</button>
            <button data-target="unit3" data-id="decisionTree" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Decision Tree</button>
            <button data-target="unit4" data-id="neuralNetwork" class="tab-btn text-sm sm:text-base font-semibold py-2 px-5 rounded-full transition-all duration-300">Neural Network</button>
        </div>
        
        <form action="{{ route('notebook.store') }}" method="POST">
            @csrf
            <div id="notepad-container" class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl shadow-gray-500/10 dark:shadow-pink-500/10 p-1">
                <textarea name="unit1Notes" id="unit1" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Empty">{{ $notes['linearReg'] ?? '' }}</textarea>
                <textarea name="unit2Notes" id="unit2" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none" placeholder="Empty">{{ $notes['logisticReg'] ?? '' }}</textarea>
                <textarea name="unit3Notes" id="unit3" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-purple-500 resize-none" placeholder="Empty">{{ $notes['decisionTree'] ?? '' }}</textarea>
                <textarea name="unit4Notes" id="unit4" class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-pink-500 resize-none" placeholder="Empty">{{ $notes['neuralNetwork'] ?? '' }}</textarea>
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="w-full sm:w-auto bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-12 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 ease-in-out transform hover:-translate-y-1">
                    Save Notes
                </button>
            </div>
        </form>
    </div>

    <script>
        const tabContainer = document.getElementById("units");
        const tabButtons = tabContainer.querySelectorAll(".tab-btn");
        const notepads = document.querySelectorAll(".notepad");

        const activeClasses = ['bg-pink-300', 'text-white', 'shadow-md'];
        const inactiveClasses = ['bg-white', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300', 'hover:bg-gray-200', 'dark:hover:bg-gray-600'];

        function switchTab(clickedButton) {
            if (!clickedButton) return;
            
            const targetId = clickedButton.dataset.target;
            const targetNotepad = document.getElementById(targetId);

            tabButtons.forEach(btn => {
                btn.classList.remove(...activeClasses);
                btn.classList.add(...inactiveClasses);
            });
            clickedButton.classList.remove(...inactiveClasses);
            clickedButton.classList.add(...activeClasses);

            notepads.forEach(pad => pad.classList.remove("active"));
            if (targetNotepad) {
                targetNotepad.classList.add("active");
            }
        }

        tabContainer.addEventListener("click", (e) => {
            const clickedButton = e.target.closest(".tab-btn");
            switchTab(clickedButton);
        });

        const firstButton = tabContainer.querySelector('.tab-btn');
        switchTab(firstButton);
        document.getElementById('unit1').classList.add('active');
    </script>
</body>
</html>