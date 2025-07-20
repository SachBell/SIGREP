<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>

<body>

    @include('partials.sidebar')
    <div class="grid grid-cols-1 lg:grid-cols-[250px,_1fr] min-h-screen">

        <main class="lg:col-start-2 overflow-y-auto">
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

            <div class="px-8 py-12">
                @livewire('notification-banner')
                <div>
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @livewireScripts()
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
</body>

</html>
