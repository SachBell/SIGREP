<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | SIGREP </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex">
    @include('partials.swa')
    @include('partials.sidebar')

    @if (request()->routeIs('admin.dashboard.user-manager.index'))
        <x-custom-modal :action="route('admin.dashboard.user-manager.massive-users')" />
    @endif

    @if (request()->routeIs('admin.dashboard.institutes.index'))
        <x-custom-modal :action="route('admin.dashboard.institutes.massive-institutes')" />
    @endif

    <main class="flex-1 h-screen overflow-x-auto">
        <div class="w-full">
            @if (Breadcrumbs::exists())
                <span class="opacity-50 breadcrumb">
                    {{ Breadcrumbs::render() }}
                </span>
            @endif
        </div>

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <div id="siteMain" class="h-full flex flex-col space-y-[5rem] animate__animated animate__fadeIn">
            <div class="py-3 px-4">
                {{ $slot }}
            </div>
        </div>
    </main>
</body>

</html>
