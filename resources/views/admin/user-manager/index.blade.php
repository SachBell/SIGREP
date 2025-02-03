@section('title', 'Gestor de Usuario')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Gestor de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        <div class="mx-auto">
            <form action="{{ route('admin.user-manager.index') }}" method="GET"
                class="flex flex-col justify-center space-y-5">
                <x-input-search type="text" name="search" placeholder="Buscar..." class="mx-4"
                    value="{{ request()->query('search') }}" required />
                <div class="flex justify-center space-x-5">
                    <x-custom-button
                        class="px-4 py-2 font-bold text-md text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">Buscar</x-custom-button>
                    <x-custom-link-button link="{{ route('admin.user-manager.index') }}"
                        class="px-4 py-2 font-bold text-md text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">Resetear</x-custom-link-button>
                </div>
            </form>
        </div>
        <div class="flex flex-col my-2">
            @if ($registros->isEmpty())
                <span class="sm:mx-4 lg:mx-4 text-md">No se encontraron usarios.</span>
            @else
                <div class="overflow-auto rounded-lg shadow mx-4">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm whitespace-nowrap">Nombre de Usuario</th>
                                <th class="p-3 text-sm whitespace-nowrap">Role</th>
                                <th class="p-3 text-sm whitespace-nowrap">Correo</th>
                                <th class="p-3 text-sm whitespace-nowrap">Contraseña</th>
                                <th class="p-3 text-sm whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100">
                            @foreach ($registros as $registro)
                                <tr>
                                    <td class="p-3 text-md text-center whitespace-nowrap">
                                        {{ $registro->name }}</td>
                                    <td class="p-3 text-md text-center whitespace-nowrap">
                                        {{ $registro->userRole->role_name ?? 'Sin Role' }}</td>
                                    <td class="p-3 text-md  text-center whitespace-nowrap">
                                        {{ $registro->email }}</td>
                                    <td class="p-3 text-md text-center whitespace-nowrap">
                                        <form action="{{ route('admin.user-manager.reset-password', $registro->id) }}"
                                            method="POST">
                                            @csrf
                                            <x-custom-button type="submit"
                                                class="inline-flex items-center px-2 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase hover:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                                :value="__('Resetear
                                                Contraseña')" />
                                        </form>
                                    </td>
                                    <td class="p-3 text-center whitespace-nowrap space-y-2">
                                        <form class="delete-form"
                                            action="{{ route('admin.user-manager.destroy', $registro->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-custom-button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                <i class="bi bi-trash-fill text-lg mt-1"></i>
                                            </x-custom-button>
                                        </form>
                                        @include('components.alert-confirm')
                                        <x-custom-link-button
                                            link="{{ route('admin.user-manager.edit', $registro->id) }}"
                                            class="px-3 py-1 font-bold text-xs text-white uppercase bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                                            <i class="bi bi-pen text-lg"></i>
                                        </x-custom-link-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="mx-w-7x1 mx-auto sm:px-4 lg:px-4 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-5">
                <div>
                    <h2 class="text-3xl font-medium text-gray-900">
                        {{ __('Nuevo Usuario') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Crea usuarios con la libertad de escoger su role.') }}
                    </p>
                </div>
                <div>
                    <x-custom-link-button link="{{ route('admin.user-manager.create') }}"
                        class="px-4 py-2 font-bold text-sm text-white bg-blue-800 hover:bg-blue-900 focus:bg-blue-700 active:bg-blue-800">
                        {{ __('Crear Usuario') }}
                    </x-custom-link-button>
                </div>
            </div>
        </div>
</x-dashboard-layout>
