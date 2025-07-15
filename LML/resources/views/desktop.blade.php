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

    <!-- Desktop Icons Container - Classes updated for absolute positioning -->
    <div id="desktop-icons" class="relative w-full h-full">
        
        <!-- Desktop Icons Container -->
        <div id="desktop-icons" class="p-4 flex flex-col flex-wrap content-start h-full">
            <a href='{{ route('models') }}' class="desktop-icon m-2">
                <img src='{{asset("images/Models.png")}}' alt="" style ="width: 50%; height:auto">
                <span>Models</span>
            </a>
            <a href='{{ route('notebook.index') }}' class="desktop-icon m-2">
                <img src='{{asset("images/notebook.png")}}' alt="" style ="width: 50%; height:auto">
                <span>Notebook</span>
            </a>
        </div>
    </div>

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

            <a href='{{ route('models') }}' class="flex items-center p-2 rounded hover:bg-white/10">
                <i class="fa-solid fa-cubes w-8 text-center"></i>
                <span>Models</span>
            </a>
            
            <a href='{{ route('notebook.index') }}' class="flex items-center p-2 rounded hover:bg-white/10">
                <i class="fa-solid fa-book-open w-8 text-center"></i>
                <span>Notebook</span>
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
            {{-- <div class="hidden md:flex items-center bg-gray-700 h-8 ml-2 rounded-sm px-2 w-48">
                <i class="fa-solid fa-search text-gray-400"></i>
                <input type="text" placeholder="Type here to search" class="bg-transparent text-white placeholder-gray-400 text-sm ml-2 w-full focus:outline-none">
            </div> --}}
        </div>

        <!-- Right side: System Tray (Time, Date) -->
        <div class="flex items-center h-full text-white text-xs">
            <div id="system-tray" class="taskbar-item text-center leading-tight">
                <div id="time">12:00 PM</div>
                <div id="date">1/1/2024</div>
            </div>
            <div class="taskbar-item" onclick="alert('Reminder: Do your Flashcards and Quizzes!');" style="cursor: pointer;">
                <i class="fa-regular fa-bell"></i>
            </div>
             <div class="w-1 h-6 bg-gray-600 rounded-full mx-1"></div>
             <div class="taskbar-item" onclick="location.reload();" style="cursor: pointer;">
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
            const timeString = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
            const dateString = now.toLocaleDateString('en-US', { month: 'numeric', day: 'numeric', year: 'numeric' });
            timeElement.textContent = timeString;
            dateElement.textContent = dateString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    
        // --- Start Menu Functionality ---
        const startButton = document.getElementById('start-button');
        const startMenu = document.getElementById('start-menu');
        document.addEventListener('click', (event) => {
            if (startButton.contains(event.target)) {
                event.stopPropagation();
                startMenu.classList.toggle('hidden');
                startMenu.classList.toggle('open');
            } else if (startMenu.classList.contains('open') && !startMenu.contains(event.target)) {
                startMenu.classList.add('hidden');
                startMenu.classList.remove('open');
            }
        });
    
        // --- Draggable Desktop Icons (FIXED CODE) ---
        function initializeDraggableIcons() {
            const icons = document.querySelectorAll('.desktop-icon');
            let top = 16;
            let left = 16;
            const iconHeight = 100;
            const iconWidth = 100;
            const verticalGap = 16;
            const horizontalGap = 16;
    
            // Set initial positions for icons in a grid
            icons.forEach(icon => {
                // Remove margin classes from Tailwind if they exist
                icon.classList.remove('m-2');
    
                icon.style.top = `${top}px`;
                icon.style.left = `${left}px`;
    
                top += iconHeight + verticalGap;
                // Check if next icon would go off-screen vertically (leaving space for taskbar)
                if (top + iconHeight > window.innerHeight - 48) { 
                    top = 16; // Reset to top
                    left += iconWidth + horizontalGap; // Move to next column
                }
                makeDraggable(icon);
            });
        }
    
        function makeDraggable(element) {
            let hasDragged = false;
    
            element.addEventListener('mousedown', (e) => {
                // Only drag with the left mouse button
                if (e.button !== 0) return;
                
                hasDragged = false;
                element.classList.add('dragging');
    
                // Calculate the mouse's initial offset from the element's top-left corner
                const offsetX = e.clientX - element.getBoundingClientRect().left;
                const offsetY = e.clientY - element.getBoundingClientRect().top;
    
                function onMouseMove(e) {
                    hasDragged = true; // If the mouse moves, we consider it a drag
                    
                    // Calculate the icon's new position
                    let newLeft = e.clientX - offsetX;
                    let newTop = e.clientY - offsetY;
    
                    // Keep the icon within the viewport boundaries
                    const taskbarHeight = 48;
                    const rightBoundary = window.innerWidth - element.offsetWidth;
                    const bottomBoundary = window.innerHeight - element.offsetHeight - taskbarHeight;
    
                    newLeft = Math.max(0, Math.min(newLeft, rightBoundary));
                    newTop = Math.max(0, Math.min(newTop, bottomBoundary));
    
                    element.style.left = `${newLeft}px`;
                    element.style.top = `${newTop}px`;
                }
    
                function onMouseUp() {
                    element.classList.remove('dragging');
    
                    // **The Fix**: Remove the listeners from the document to stop tracking
                    document.removeEventListener('mousemove', onMouseMove);
                    document.removeEventListener('mouseup', onMouseUp);
                }
    
                // Add listeners to the whole document to track the mouse everywhere
                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });
    
            // Prevent the browser's default drag behavior, which can interfere
            element.addEventListener('dragstart', (e) => e.preventDefault());
            
            element.addEventListener('click', (e) => {
                 e.preventDefault();
            });
            element.addEventListener('dblclick', (e) => {
            // Only navigate if the icon wasn't dragged
                if (!hasDragged) {
                window.location.href = element.href;
                }
                });

            // Prevent the link from being followed if the icon was dragged
            element.addEventListener('click', (e) => {
                if (hasDragged) {
                    e.preventDefault();
                }
            });
        }
    
        // Initialize the draggable icons once the window has fully loaded
        window.addEventListener('load', initializeDraggableIcons);
    </script>

</body>
</html>