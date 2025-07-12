<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windows 10 Desktop</title>
    <!-- Tailwind CSS for utility classes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Link to your custom stylesheet -->
    <link rel="stylesheet" href='{{asset("css/desktopstyle.css")}}'>
    <!-- Google Fonts for Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="desktop-background">

    <!-- Desktop Icons Container -->
    <div id="desktop-icons" class="p-4 flex flex-col flex-wrap content-start h-full">
        <!-- Icon 1: This PC -->
        <a href='{{ route('flashcards') }}' class="desktop-icon m-2">
        <img src='{{asset("images/FlashQT.png")}}' alt="This PC">
        <span>Flashcards</span>
        </a>

        <!-- Icon 2: Recycle Bin -->
        <a href='{{ route('voila') }}' class="desktop-icon m-2">
            <img src='{{asset("images/notebook.png")}}' alt="">
            <span>LML Notebooks</span>
        </a>
        <!-- Icon 3: Project Folder -->
        <a href='{{ route('quiz') }}' class="desktop-icon m-2">
            <img src='{{asset("images/Quiz.png")}}' alt="">
            <span>Quiz</span>
        </a>
         <!-- Icon 4: Another Page Link -->
        <a href="#" class="desktop-icon m-2">
            <i class="fa-solid fa-file-code"></i>
            <span>Page 2</span>
        </a>
    </div>

    {{-- <!-- Start Menu (Initially Hidden) -->
    <div id="start-menu" class="hidden">
        <div class="p-4 text-white">
            <h2 class="text-xl font-bold mb-4">Start</h2>
            <!-- You can add start menu items here -->
            <div class="flex flex-col space-y-2">
                <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-cog w-8 text-center"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-image w-8 text-center"></i>
                    <span>Pictures</span>
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-file-alt w-8 text-center"></i>
                    <span>Documents</span>
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-power-off w-8 text-center"></i>
                    <span>Power</span>
                </a>
            </div>
        </div>
    </div> --}}

    <!-- Start Menu (Initially Hidden) -->
<div id="start-menu" class="hidden">
    <div class="p-4 text-white">
        <h2 class="text-xl font-bold mb-4">Start</h2>
        <div class="flex flex-col space-y-2">
            <!-- Other menu items remain as links -->
            <a href='{{ route('profile.edit') }}' class="flex items-center p-2 rounded hover:bg-white/10">
                <i class="fa-solid fa-cog w-8 text-center"></i>
                <span>Settings</span>
            </a>

            

            <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                <i class="fa-solid fa-image w-8 text-center"></i>
                <span>Pictures</span>
            </a>
            <a href="#" class="flex items-center p-2 rounded hover:bg-white/10">
                <i class="fa-solid fa-file-alt w-8 text-center"></i>
                <span>Documents</span>
            </a>

            <!-- START: Sign-out button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center p-2 rounded hover:bg-white/10 text-left">
                    <i class="fa-solid fa-power-off w-8 text-center"></i>
                    <span>Power</span>
                </button>
            </form>
            <!-- END: Sign-out button -->

        </div>
    </div>
</div>


    <!-- Taskbar -->
    <div class="taskbar flex items-center justify-between px-2">
        <!-- Left side: Start, Search -->
        <div class="flex items-center h-full">
            <!-- Start Button -->
            <button id="start-button" class="taskbar-item" aria-label="Start Menu">
                <i class="fab fa-windows text-xl text-blue-400"></i>
            </button>
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-700 h-8 ml-2 rounded-sm px-2 w-48">
                <i class="fa-solid fa-search text-gray-400"></i>
                <input type="text" placeholder="Type here to search" class="bg-transparent text-white placeholder-gray-400 text-sm ml-2 w-full focus:outline-none">
            </div>
        </div>

        <!-- Right side: System Tray (Time, Date) -->
        <div class="flex items-center h-full text-white text-xs">
            <div id="system-tray" class="taskbar-item text-center leading-tight">
                <div id="time">12:00 PM</div>
                <div id="date">1/1/2024</div>
            </div>
            <div class="taskbar-item">
                <i class="fa-regular fa-bell"></i>
            </div>
             <div class="w-1 h-6 bg-gray-600 rounded-full mx-1"></div>
             <div class="taskbar-item">
                <i class="fa-solid fa-desktop"></i>
            </div>
        </div>
    </div>

    <script>
        // --- Clock and Date Functionality ---
        const timeElement = document.getElementById('time');
        const dateElement = document.getElementById('date');

        function updateClock() {
            const now = new Date();
            // Format time with AM/PM
            const timeString = now.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            // Format date
            const dateString = now.toLocaleDateString('en-US', {
                month: 'numeric',
                day: 'numeric',
                year: 'numeric'
            });

            timeElement.textContent = timeString;
            dateElement.textContent = dateString;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);
        // Initial call to display immediately
        updateClock();

        // --- Start Menu Functionality ---
        const startButton = document.getElementById('start-button');
        const startMenu = document.getElementById('start-menu');
        const desktopIcons = document.getElementById('desktop-icons');

        startButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent click from bubbling up to the document
            startMenu.classList.toggle('hidden');
            startMenu.classList.toggle('open');
        });

        // Close the start menu if clicking anywhere else on the desktop
        document.addEventListener('click', (event) => {
            // Check if the click is outside the start menu and not on the start button
            if (!startMenu.contains(event.target) && !startButton.contains(event.target)) {
                if (startMenu.classList.contains('open')) {
                    startMenu.classList.add('hidden');
                    startMenu.classList.remove('open');
                }
            }
        });
    </script>

</body>
</html>
