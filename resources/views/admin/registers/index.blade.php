@section('title', 'Registros')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Registros de Practicas Preprofesionales ISUS 2024-II') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="mx-auto">
            <form action="{{ route('admin.registros.index') }}" method="GET"
                class="flex flex-col justify-center space-y-5">
                <x-input-search type="text" name="search" placeholder="Buscar..." class="mx-4"
                    value="{{ request()->query('search') }}" required />
                <div class="flex justify-center space-x-5">
                    <x-custom-button
                        class="px-4 py-2 font-bold text-md text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">Buscar</x-custom-button>
                    <x-custom-link-button link="{{ route('admin.registros.index') }}"
                        class="px-4 py-2 font-bold text-md text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">Resetear</x-custom-link-button>
                </div>
            </form>
        </div>

        <div class="flex flex-col my-2">
            @if ($registros->isEmpty())
                <span class="text-md">No se encontraron Registros.</span>
            @else
                <div class="mx-w-7x1 sm:mx-4 lg:mx-4 overflow-auto rounded-lg shadow">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm whitespace-nowrap">ID</th>
                                <th class="p-6 text-sm whitespace-nowrap">CEI</th>
                                <th class="p-6 text-sm whitespace-nowrap">Nombres</th>
                                <th class="p-6 text-sm whitespace-nowrap">Apellidos</th>
                                <th class="p-6 text-sm whitespace-nowrap">Celular</th>
                                <th class="p-6 text-sm whitespace-nowrap">Correo</th>
                                <th class="p-6 text-sm whitespace-nowrap">Dirección</th>
                                <th class="p-6 text-sm whitespace-nowrap">Barrio</th>
                                <th class="p-6 text-sm whitespace-nowrap">Semestre</th>
                                <th class="p-6 text-sm whitespace-nowrap">Paralelo</th>
                                <th class="p-6 text-sm whitespace-nowrap">Jornada</th>
                                <th class="p-6 text-sm whitespace-nowrap">Institución</th>
                                <th class="p-6 text-sm whitespace-nowrap">Dirección Institución</th>
                                <th class="p-6 text-sm whitespace-nowrap">Registro</th>
                                <th class="p-6 text-sm whitespace-nowrap">Modificación</th>
                                <th class="p-6 text-sm whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100">
                            @foreach ($registros as $registro)
                                <tr>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->id }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->cei }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->name }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->lastname }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->phone_number }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->email }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->address }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->neighborhood }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->semesters->semester ?? 'Sin Asignar' }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->grades->grade ?? 'Sin Asignar' }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->daytrip }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->applicationDetails->first()?->institutes->name ?? 'Sin Asignar' }}
                                    </td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->applicationDetails->first()?->institutes->address ?? 'Sin Asignar' }}
                                    </td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->created_at }}</td>
                                    <td class="p-3 align-middle whitespace-nowrap">
                                        {{ $registro->updated_at }}</td>
                                    <td class="p-3 text-center whitespace-nowrap space-y-2">
                                        <form class="delete-form"
                                            action="{{ route('admin.registros.destroy', $registro->id) }}"
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
                                            link="{{ route('admin.registros.edit', $registro->id) }}"
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
        <!-- Paginación -->
        <div class="flex justify-center">
            {{ $registros->links() }}
        </div>
        <div class="mx-w-7x1 mx-auto sm:px-4 lg:px-4 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-5">
                <div>
                    <h2 class="text-3xl font-medium text-gray-900">
                        {{ __('Descargar Registros') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Puedes descargar los registros de los estudiantes.') }}
                    </p>
                </div>
                <div>
                    <x-custom-link-button link="{{ route('admin.registros.export') }}"
                        class="px-4 py-2 font-bold text-sm text-white bg-green-700 hover:bg-green-800 focus:bg-green-800 active:bg-green-900">
                        {{ __('Descargar Registros') }}
                    </x-custom-link-button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
