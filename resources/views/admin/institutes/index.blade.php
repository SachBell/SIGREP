@section('title', 'Gestor de Institutos')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Gestor de Institutos') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="flex px-5 gap-3">
            <form class="w-full flex justify-end gap-4" action="{{ route('admin.dashboard.institutes.search') }}"
                method="GET">
                <input type="text" name="query" id="search" class="input ps-4 max-w-sm"
                    placeholder="Buscar usuarios" value="{{ request('query') }}">

                <div class="relative group">
                    <div class="flex items-center gap-4">
                        <a class="btn btn-md btn-error px-2" href="{{ route('admin.dashboard.institutes.index') }}">
                            <span class="icon-[tabler--refresh] size-5"></span>
                        </a>
                    </div>
                    <span
                        class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                        Resetear Búsqueda
                    </span>
                </div>
            </form>
            <div class="relative group">
                <x-custom-link-button link="{{ route('admin.dashboard.institutes.create') }}"
                    class="btn btn-md btn-accent px-2 bg-blue-800 hover:bg-blue-800 focus:bg-blue-700 active:bg-blue-800">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M3 21h9"></path>
                        <path d="M9 8h1"></path>
                        <path d="M9 12h1"></path>
                        <path d="M9 16h1"></path>
                        <path d="M14 8h1"></path>
                        <path d="M14 12h1"></path>
                        <path
                            d="M5 21v-16c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h10c.53 0 1.039 .211 1.414 .586c.375 .375 .586 .884 .586 1.414v7">
                        </path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                    </svg>
                </x-custom-link-button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Añadir Institución
                </span>
            </div>
            <div class="relative group">
                <button type="button"
                    class="btn btn-md px-2.5 font-bold text-sm text-white bg-cyan-800 hover:bg-cyan-900 focus:bg-cyan-700 active:bg-cyan-800"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="form-modal" data-overlay="#form-modal">
                    <span class="icon-[tabler--category-plus] size-5"></span>
                </button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Institutos por Lote
                </span>
            </div>
        </div>

        <div class="flex flex-col my-2">
            @if ($registros->isEmpty())
                <div class="card min-h-60 w-full">
                    <div class="card-body items-center justify-center">
                        <span class="icon-[tabler--brand-google-drive] mb-2 size-[10rem] opacity-34"></span>
                        <span class="mt-2 text-lg">Actualmente no hay instituciones que mostrar</span>
                        <div class="mt-8 space-y-5 lg:space-x-5">
                            <a href="{{ route('admin.dashboard.registers.create') }}"
                                class="btn btn-md bg-blue-900 border-none text-white shadow-lg hover:bg-blue-950">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M3 21h9"></path>
                                    <path d="M9 8h1"></path>
                                    <path d="M9 12h1"></path>
                                    <path d="M9 16h1"></path>
                                    <path d="M14 8h1"></path>
                                    <path d="M14 12h1"></path>
                                    <path
                                        d="M5 21v-16c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h10c.53 0 1.039 .211 1.414 .586c.375 .375 .586 .884 .586 1.414v7">
                                    </path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                </svg>
                                {{ __('Crear Registro') }}
                            </a>
                            <button type="button"
                                class="btn btn-md text-white shadow-lg border-none bg-cyan-800 hover:bg-cyan-900 focus:bg-cyan-700 active:bg-cyan-800"
                                aria-haspopup="dialog" aria-expanded="false" aria-controls="form-modal"
                                data-overlay="#form-modal">
                                <span class="icon-[tabler--category-plus] size-5"></span>
                                {{ __('Inserción Masiva') }}
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="max-w-[105rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
                    <table class="table">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Nombre</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Límite de Usuarios</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                            </tr>
                        </thead>
                        <x-custom-table :keys="$registros" />
                    </table>
                </div>
            @endif
        </div>
        <x-custom-pagination :key="$registros" />
    </div>
</x-dashboard-layout>
