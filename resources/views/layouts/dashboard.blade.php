<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | ISUS</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.swa')
    <div class="flex h-screen bg-gray-100">

        {{-- SideBar --}}
        @include('partials.sidebar')

        {{-- Main Content --}}
        <main class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between min-h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">
                    @if (Breadcrumbs::exists())
                        <span class="opacity-50 breadcrumb">
                            {{ Breadcrumbs::render() }}
                        </span>
                    @endif
                </div>
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

            <div id="siteMain" class="h-full mt-3 animate__animated animate__fadeIn">
                <div>
                    {{ $slot }}
                </div>
                @include('partials.footer')
            </div>
        </main>
    </div>
</body>

</html>
