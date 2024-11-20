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

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen grid md:grid-cols-2">
        <div class="md:flex flex-col justify-center items-center hidden">
            <a href="/">
                <x-application-logo class="w-96 h-96 fill-current text-gray-500" />
            </a>
        </div>
        <div class="bg-gradient-to-r from-blue-500 to-80% to-blue-900 md:rounded-l-[2rem] text-white p-6">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
