{{--
    /resources/views/welcome.blade.php

    This is a "swipe-to-unlock" style welcome page that redirects to the login page.
    It uses Alpine.js for interactivity and Tailwind CSS for styling.
--}}
<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hello
</body>
</html>
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - My App</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Ensure the background image covers the whole screen */
        .bg-cover-full {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="antialiased">
    <div
        x-data="{
            isLocked: true,
            dragging: false,
            startY: 0,
            currentY: 0,
            time: new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }),
            date: new Date().toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' }),
            
            init() {
                setInterval(() => {
                    const now = new Date();
                    this.time = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
                    this.date = now.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' });
                }, 1000);
            },

            startDrag(event) {
                if (!this.isLocked) return;
                this.dragging = true;
                this.startY = event.pageY || event.touches[0].pageY;
            },

            drag(event) {
                if (!this.dragging) return;
                this.currentY = event.pageY || event.touches[0].pageY;
                const diff = this.startY - this.currentY;
                if (diff > 50) { // Swipe threshold
                    this.unlock();
                }
            },

            stopDrag() {
                this.dragging = false;
            },
            
            unlock() {
                if (!this.isLocked) return; // Prevent multiple calls
                this.isLocked = false;
                this.dragging = false;
                // Wait for the animation to finish, then redirect.
                setTimeout(() => {
                    // Assuming you have a named route for login.
                    // If not, you can use a static URL like '/login'.
                    window.location.href = '{{ route("login") }}';
                }, 700); // This duration should match the transition duration.
            }
        }"
        class="relative h-screen w-screen overflow-hidden bg-gray-900"
    >
        {{-- Lock Screen Overlay --}}
        <div
            x-show="isLocked"
            @mousedown="startDrag($event)"
            @mousemove="drag($event)"
            @mouseup="stopDrag()"
            @mouseleave="stopDrag()"
            @touchstart="startDrag($event)"
            @touchmove="drag($event)"
            @touchend="stopDrag()"
            x-transition:leave="transition ease-in duration-700"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-full"
            class="absolute inset-0 z-10 flex flex-col justify-center items-center bg-cover-full cursor-pointer"
            style="background-image: url('https://placehold.co/1920x1080/000000/FFFFFF?text=Welcome')"
        >
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative text-center text-white z-20">
                <h1 class="text-8xl font-bold" x-text="time"></h1>
                <p class="text-2xl mt-2" x-text="date"></p>
                <p class="mt-24 text-lg animate-pulse">Click and drag up to login</p>
            </div>
        </div>
    </div>
</body>
</html>
>>>>>>> main
