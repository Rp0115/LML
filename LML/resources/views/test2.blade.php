<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Sidebar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        {{-- This is our new sidebar component --}}
        <x-sidebar />

        {{-- Main Content --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            <div class="lg:ml-16"> {{-- Add left margin to account for hamburger menu on mobile --}}
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <p class="mt-2 text-gray-600">Welcome to your dashboard.</p>

                {{-- Your page content goes here --}}
                <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
                    {{-- Example content --}}
                    <p>This is where your main page content will be displayed. The sidebar will stay fixed on the left.</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
</x-app-layout>