@section('title', 'Roles y Permisos')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Gestor de Roles y Permisos') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="flex justify-end px-5 gap-3">
            <div class="relative group">
                <x-custom-link-button link="{{ route('admin.dashboard.rolespermissions.create') }}"
                    class="btn btn-md font-semibold text-sm text-white bg-blue-800 hover:bg-blue-900 focus:bg-blue-700 active:bg-blue-800">
                    {{ __('Nuevo Role') }}
                    <span class="icon-[tabler--plus] size-5"></span>
                </x-custom-link-button>
                <span
                    class="absolute text-center left-1/2 -translate-x-1/2 -top-12 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                    Nuevo Rol
                </span>
            </div>
        </div>
        <div class="max-w-[110rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-sm text-center whitespace-nowrap font-semibold py-5">Nombre</th>
                        <th class="text-sm text-center whitespace-nowrap font-semibold py-5">Permisos</th>
                        <th class="text-sm text-center whitespace-nowrap font-semibold py-5">Acciones</th>
                    </tr>
                </thead>
                <x-custom-table :keys="$roles" />
            </table>
            {{-- <x-custom-pagination :key="$roles" /> --}}
        </div>
    </div>
</x-dashboard-layout>
