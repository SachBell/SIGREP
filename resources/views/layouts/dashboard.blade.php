<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | ISUS</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.swa')
    <div class="flex h-screen bg-gray-100">

        {{-- SideBar --}}
        @include('partials.sidebar')

        {{-- Main Content --}}
        <main class="flex flex-col flex-1 overflow-auto">
            <div class="flex items-center justify-end min-h-16 bg-white border-b border-gray-200">
                <div class="md:hidden flex items-center px-4">
                    <button id="sidebar-open" class="mr-4 px-2 py-1 bg-gray-300 rounded focus:outline-none text-2xl">
                        <i class="bi bi-grid"></i>
                    </button>
                </div>
            </div>

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <div id="siteMain" class="mt-3 min-h-100">
                <div>
                    {{ $slot }}
                </div>
            </div>

            @include('partials.footer')
        </main>

    </div>
</body>

</html>
