<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Preloader -->
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 999999; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s ease, visibility 0.5s ease;">
        <div class="text-center d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Sakn Logo" style="max-height: 80px; animation: saknPulse 2s infinite ease-in-out;">
            <span style="font-family: 'Outfit', sans-serif; font-size: 3rem; font-weight: 800; color: #2F4F3E; margin-left: 15px; letter-spacing: -2px;">SAKN</span>
        </div>
    </div>

    <style>
        @keyframes saknPulse {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.8; }
        }
        .preloader-hidden {
            opacity: 0 !important;
            visibility: hidden !important;
        }
    </style>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const preloader = document.getElementById('preloader');
            
            // Set to 2 seconds for a perfect balance
            setTimeout(() => {
                if (preloader) {
                    preloader.classList.add('preloader-hidden');
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 500);
                }
            }, 2000);
        });
    </script>
</body>
</html>
