{{--
    /resources/views/components/sidebar.blade.php

    This is a responsive, collapsible sidebar component.
    The expanded/collapsed state is controlled by the toggle button.
    It uses Tailwind CSS for styling and Alpine.js for interactivity.

    Usage in your layout file (e.g., app.layout.blade.php):
    <div class="flex">
        <x-sidebar />
        <main class="flex-1 p-6">
            <!-- Your content -->
        </main>
    </div>
--}}

@props([
    'items' => [
        ['label' => 'Dashboard', 'icon' => 'home', 'route' => '#'],
        ['label' => 'Team', 'icon' => 'users', 'route' => '#'],
        ['label' => 'Projects', 'icon' => 'folder', 'route' => '#'],
        ['label' => 'Calendar', 'icon' => 'calendar', 'route' => '#'],
        ['label' => 'Documents', 'icon' => 'file-text', 'route' => '#'],
        ['label' => 'Reports', 'icon' => 'bar-chart-2', 'route' => '#'],
    ]
])

{{-- The entire sidebar is now a single Alpine.js component. --}}
{{-- The `open` state determines if the sidebar is expanded or collapsed. --}}
<aside
    x-data="{ open: true }"
    class="bg-gray-800 text-white h-screen flex flex-col flex-shrink-0 transition-all duration-300 ease-in-out"
    :class="open ? 'w-64' : 'w-20'"
>
    <div class="flex flex-col h-full">
        {{-- Logo and Toggle Button --}}
        {{-- MODIFIED: Parent is now relative and centers content. Button is absolute. --}}
        <div class="relative flex items-center justify-center h-20 px-4 border-b border-gray-700">
            {{-- Toggle Button --}}
            <button @click="open = !open" class="absolute left-4 p-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>
            
            {{-- Logo --}}
            <a href="#" class="flex items-center space-x-3 overflow-hidden" x-show="open">
                <svg class="h-8 w-8 text-indigo-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M12 6V4m0 16v-2M8 8l1.414-1.414M14.586 14.586L16 16m-1.414 1.414L16 16m-5.414-1.414L9.414 16M16 8l-1.414-1.414M8 16l1.414 1.414m4.172-9.172L12 8m0 8l-1.414 1.414" />
                </svg>
                <span class="font-bold text-xl whitespace-nowrap" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">My App</span>
            </a>
        </div>

        {{-- Navigation Links --}}
        <nav class="flex-1 mt-6 space-y-2">
            @foreach ($items as $item)
                <a
                    href="{{ $item['route'] }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200"
                >
                    <i data-feather="{{ $item['icon'] }}" class="h-6 w-6 flex-shrink-0"></i>
                    <span class="ml-4 whitespace-nowrap" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- {{-- User Profile --}}
        <div class="border-t border-gray-700">
            <a
                href="#"
                class="flex items-center px-6 py-4 hover:bg-gray-700 transition-colors duration-200 overflow-hidden"
            >
                <img class="h-10 w-10 rounded-full object-cover flex-shrink-0" src="https://placehold.co/40x40/667eea/e2e8f0?text=U" alt="User avatar">
                <div class="ml-4 whitespace-nowrap" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <p class="font-semibold text-sm">John Doe</p>
                    <p class="text-xs text-gray-400">View profile</p>
                </div>
            </a>
        </div> -->
    </div>
</aside>

{{-- This script is for the Feather Icons used in the menu. --}}
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    // We need to call feather.replace() whenever Alpine.js might change the DOM.
    // A simple way is to observe the body for changes.
    document.addEventListener('alpine:init', () => {
        Alpine.mutateDom(() => {
            feather.replace();
        });
    });
</script>
