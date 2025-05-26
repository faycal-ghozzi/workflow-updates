<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6 py-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="flex justify-center mb-6">
            <a href="/">
                <x-application-logo class="w-16 h-16 fill-current text-gray-600 dark:text-gray-300" />
            </a>
        </div>

        {{ $slot }}
    </div>

    @include('layout.footer')
    @include('partials.scripts')
</body>
</html>
