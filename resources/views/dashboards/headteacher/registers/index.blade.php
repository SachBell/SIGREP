@section('title', 'Gestor de Registros')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Registros de Practicas Preprofesionales ISUS 2024-II') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="flex px-5 gap-3">
            <form class="w-full flex justify-end gap-4" action="{{ route('admin.dashboard.registers.search') }}"
                method="GET">
                <input type="text" name="query" id="search" class="input ps-4 max-w-sm"
                    placeholder="Buscar usuarios" value="{{ request('query') }}">

                <div class="relative group">
                    <div class="flex items-center gap-4">
                        <a class="btn btn-md btn-error px-2" href="{{ route('admin.dashboard.registers.index') }}">
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
                <x-custom-link-button link="{{ route('admin.dashboard.registers.export') }}"
                    class="btn btn-md px-2 btn-success bg-green-700 hover:bg-green-800 focus:bg-green-800 active:bg-green-900">
                    <span class="icon-[tabler--download] size-5"></span>
                </x-custom-link-button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Descargar Registros
                </span>
            </div>
        </div>
        <div class="flex flex-col my-2">
            @if ($registros->isEmpty())
                <div class="card min-h-60 w-full">
                    <div class="card-body items-center justify-center">
                        <span class="icon-[tabler--brand-google-drive] mb-2 size-[10rem] opacity-34"></span>
                        <span class="mt-2 text-lg">Actualmente no hay registros que mostrar</span>
                        <div class="mt-8">
                            <a href="{{ route('admin.dashboard.registers.create') }}"
                                class="btn btn-md bg-blue-900 border-none text-white shadow-lg hover:bg-blue-950">
                                <span class="icon-[tabler--plus] size-5"></span>
                                {{ __('Crear Registro') }}
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="max-w-[105rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
                    <table class="table">
                        <thead>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Cedula</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Nombres</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Apellidos</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Teléfono</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Barrio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Semestre</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Paralelo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Jornada</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Periodo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Institución</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </thead>
                        <x-custom-table :keys="$registros" />
                    </table>
                </div>
            @endif
        </div>
        <x-custom-pagination :key="$registros" />
    </div>
</x-dashboard-layout>
