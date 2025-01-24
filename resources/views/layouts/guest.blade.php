<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | SIGREP</title>
    <script src="https://kit.fontawesome.com/be6056a694.js" crossOrigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="px-4">
            <img src="{{asset('img/logo.png')}}" alt="logo.png" class="w-50 h-50 fill-current bg-white rounded" width="450px">
        </div>

        <div class="w-full sm:max-w-md mt-6 px-9 py-7 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
