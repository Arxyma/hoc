<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>
</html>
