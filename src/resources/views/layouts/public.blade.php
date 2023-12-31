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
    <body class="font-sans text-gray-900 dark:text-gray-200 dark:bg-gray-900 antialiased px-4">
    <header>
        <div class="container mx-auto">
            <nav class="flex justify-between items-center py-2">
                <div>
                    <a href="/" class="py-1 inline-flex items-center text-xl font-black">
                        FrankDev
                    </a>
                </div>
                <div>
                    <ul class="flex items-center gap-8">
                        <li>
                            <a href="/tutorials"
                               class="py-1 px-2 inline-flex items-center">
                                Tutorials
                            </a>
                        </li>
                        <li>
                            <a href="/courses"
                               class="py-1 px-2 inline-flex items-center">
                                <span>Courses</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tip-and-tricks"
                               class="py-1 px-2 inline-flex items-center">
                                Tips and Tricks
                            </a>
                        </li>
                    </ul>



                </div>
                <div>
                    <x-primary-button>Join Premium</x-primary-button>
                </div>
            </nav>
        </div>
    </header>

    {{ $slot }}




    </body>
</html>
