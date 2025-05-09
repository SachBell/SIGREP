@section('title', 'Gestor de Usuario')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Gestor de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="flex px-5 gap-3">
            <form class="w-full flex justify-end gap-4" action="{{ route('admin.dashboard.user-manager.search') }}"
                method="GET">
                <input type="text" name="query" id="search" class="input ps-4 max-w-sm"
                    placeholder="Buscar usuarios" value="{{ request('query') }}" value="127">

                <div class="relative group">
                    <div class="flex items-center gap-4">
                        <a class="btn btn-md btn-error px-2" href="{{ route('admin.dashboard.user-manager.index') }}">
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
                <x-custom-link-button link="{{ route('admin.dashboard.user-manager.create') }}"
                    class="btn btn-md px-2 font-bold text-sm text-white bg-blue-800 hover:bg-blue-900 focus:bg-blue-700 active:bg-blue-800">
                    <span class="icon-[tabler--user-plus] size-5"></span>
                </x-custom-link-button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Nuevo Usuario
                </span>
            </div>
            <div class="relative group">
                <button type="button"
                    class="btn btn-md px-2.5 font-bold text-sm text-white bg-cyan-800 hover:bg-cyan-900 focus:bg-cyan-700 active:bg-cyan-800"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="form-modal" data-overlay="#form-modal">
                    <span class="icon-[tabler--users-group] size-5"></span>
                </button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Usuarios por Lote
                </span>
            </div>
        </div>
        <div class="max-w-[110rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
            <table class="table">
                <thead>
                    <th class="text-sm whitespace-nowrap font-semibold py-5">Nombre de Usuario</th>
                    <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                    <th class="text-sm whitespace-nowrap font-semibold py-5">Role</th>
                    <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                </thead>
                <x-custom-table :keys="$registros" />
            </table>
        </div>

        <x-custom-pagination :key="$registros" />
    </div>
</x-dashboard-layout>

{{-- massiveUsersImport --}}
