<div class="space-y-4">
    @livewire('career-modal')
    <div class="flex flex-col flex-wrap gap-3 sm:flex-row sm:items-center sm:justify-between" wire:ignore>
        <div class="dropdown relative inline-flex">
            <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-outline btn-secondary font-normal"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--clock]"></span>
                {{ __('Filtrar por tipo') }}
                <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-10 p-0" role="menu"
                aria-orientation="vertical" aria-labelledby="dropdown-default">
                <li>
                    <a class="dropdown-item" href="" wire:click.prevent="$set('selectedType', null)">Todos</a>
                    @foreach ($types as $key)
                <li>
                    <a class="dropdown-item" href=""
                        wire:click.prevent="$set('selectedType', @js($key))">{{ $key ? 'Dual' : 'Tradicional' }}</a>
                </li>
                @endforeach
                </li>
            </ul>
        </div>
        <div class="w-full max-w-lg relative flex justify-between md:justify-normal sm:w-auto sm:max-w-none gap-5">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input ps-8 focus:border-blue-500" wire:model="search" type="text" role="combobox"
                    aria-expanded="false" placeholder="Buscar carrera" />
            </div>
            <div class="relative">
                <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                    <span class="icon-[tabler--apps] size-5"></span>
                    {{ __('Nueva Carrera') }}
                </button>
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        @if ($careers->isEmpty())
            <div class="card min-h-60 w-full">
                <div class="card-body items-center justify-center">
                    <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                    <span>No hay datos que mostrar</span>
                </div>
            </div>
        @else
            <div class="overflow-auto h-fit bg-white rounded-lg shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Nombre</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Tipo de Carrera</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        @foreach ($careers as $career)
                            <tr>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    {{ $career->name }}
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    @if ($career->is_dual == true)
                                        {{ __('Dual') }}
                                    @else
                                        {{ __('Tradicional') }}
                                    @endif
                                </th>
                                <th class="flex py-5">
                                    <button onclick="Livewire.emit('openEdit', {{ $career->id }})"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--pencil] size-6"></span>
                                    </button>
                                    <form action="{{ route('careers.destroy', $career->id) }}" class="delete-form"
                                        action="" method="POST">
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
