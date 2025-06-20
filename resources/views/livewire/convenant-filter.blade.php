<div class="space-y-4">
    @livewire('convenant-modal')
    <div class="flex flex-col flex-wrap gap-3 sm:flex-row sm:items-center sm:justify-between" wire:ignore>
        <div class="dropdown relative inline-flex">
            <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-outline btn-secondary font-normal"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--clock]"></span>
                {{ __('Filtrar por estado') }}
                <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-10 p-0" role="menu"
                aria-orientation="vertical" aria-labelledby="dropdown-default">
                <li>
                    <a class="dropdown-item" href="" wire:click.prevent="$set('career', '')">Todos</a>
                </li>
                @foreach ($careers as $id => $name)
                    <li>
                        <a wire:click.prevent="$set('career', {{ $id }})" class="dropdown-item"
                            href="">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-full max-w-lg relative flex justify-between md:justify-normal sm:w-auto sm:max-w-none gap-5">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input ps-8 focus:border-blue-500" wire:model="search" type="text" role="combobox"
                    aria-expanded="false" placeholder="Buscar convenio" />
            </div>
            <div class="relative">
                <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                    <span class="icon-[tabler--apps] size-5"></span>
                    {{ __('Nuevo Convenio') }}
                </button>
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        @if ($convenants->isEmpty())
            <div class="card min-h-60 w-full">
                <div class="card-body items-center justify-center">
                    <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                    <span>No hay datos que mostrar</span>
                </div>
            </div>
        @else
            <div class="max-w-[105rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
                <table class="table">
                    <thead>
                        <tr>
                            @role('admin')
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Carrera</th>
                            @endrole
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Nombre</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Limite de Estudiantes</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Sector Productivo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Director</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Cédula</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Teléfono</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Inicio del Convenio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Fin del Convenio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Observaciones</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        @foreach ($convenants as $convenant)
                            <tr>
                                @role('admin')
                                    <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        {{ $convenant->careers->first()->name }}
                                    </th>
                                @endrole
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->name }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->address }}
                                </th>
                                <th class="text-md normal-case text-center font-normal whitespace-nowrap py-5">
                                    {{ $convenant->user_limit }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->productive_sector }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->principalData->name . ' ' . $convenant->principalData->lastname }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->principalData->id_card }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->principalData->email }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->principalData->phone_number }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->convenant_start_date }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->convenant_end_date }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $convenant->observations ?: 'N/A' }}
                                </th>
                                <th class="flex py-5">
                                    <button onclick="Livewire.emit('openEdit', {{ $convenant->id }})"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--pencil] size-6"></span>
                                    </button>
                                    <form class="delete-form"
                                        action="{{ route('convenants.destroy', $convenant->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-circle btn-text btn-sm"
                                            aria-label="Action button"><span
                                                class="icon-[tabler--trash] size-6"></span></button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
