@if ($calls->isEmpty())
    <span>No hay datos</span>
@else
    <div class="w-full grid md:grid-cols-2 lg:grid-cols-3 place-items-center md:justify-center gap-8">
        @foreach ($calls as $call)
            <div wire:key="call-{{ $call->id }}"
                class="card w-full sm:max-w-md py-12 px-5 hover:shadow-lg transition duration-300
                    @if ($call->status === 'Activo') bg-green-50
                    @elseif ($call->status === 'Finalizado') bg-red-50 @endif">

                <div class="relative">
                    <div
                        class="absolute top-0 left-0 h-full w-1 rounded-l-full
                        @if ($call->status === 'Activo') bg-green-400
                        @elseif ($call->status === 'Finalizado') bg-red-400 @endif">
                    </div>
                </div>

                @hasanyrole(['admin', 'gestor-teacher'])
                    <div class="absolute right-2 top-2">
                        <div
                            class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                            <button id="dropdown-toggle-{{ $call->id }}" type="button"
                                class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 size-10"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <div class="indicator">
                                    <span class="icon-[tabler--dots-vertical] text-base-content size-6"></span>
                                </div>
                            </button>
                            <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                                aria-orientation="horizontal" aria-labelledby="dropdown-toggle-{{ $call->id }}">
                                <div class="overflow-auto text-base-content/80 max-h-56 max-md:max-w-30">
                                    <div class="flex flex-col">
                                        <button wire:click="$emit('openEdit', {{ $call->id }})"
                                            class="dropdown-item inline-flex items-center gap-2">
                                            <span class="icon-[tabler--pencil] size-5"></span>
                                            {{ __('Editar') }}
                                        </button>
                                        <button wire:click="$emit('delete', {{ $call->id }})"
                                            class="dropdown-item inline-flex items-center gap-2">
                                            <span class="icon-[tabler--trash] size-5"></span>
                                            {{ __('Eliminar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="flex justify-center">
                    <figure
                        class="max-w-fit inline-flex mb-2 p-3 rounded-full
                        @if ($call->status === 'Activo') bg-green-100
                        @elseif ($call->status === 'Finalizado') bg-red-100
                        @else bg-gray-100 @endif">
                        <span
                            class="icon-[tabler--speakerphone] size-16
                            @if ($call->status === 'Activo') text-green-500/50
                            @elseif ($call->status === 'Finalizado') text-red-600/70
                            @else text-gray-600 @endif"></span>
                    </figure>
                </div>

                <div class="flex justify-end mb-4">
                    <span
                        class="badge badge-default
                        @if ($call->status === 'Activo') badge-success bg-green-600
                        @else badge-error @endif">
                        <span class="icon-[tabler--circle-check-filled] size-4"></span>
                        {{ $call->status === 'Activo' ? __('Activo') : __('Finalizado') }}
                    </span>
                </div>

                <hr class="mb-2 border-gray-300/50">

                <div class="card-body">
                    <h5 class="card-title text-lg font-semibold mb-5">{{ $call->name }}</h5>
                    <div class="flex flex-col mb-5 gap-4">
                        <div class="flex justify-between gap-8 mb-5">
                            <div class="inline-flex items-center gap-4">
                                <span class="icon-[tabler--calendar-plus] size-6"></span>
                                <span class="font-medium">{{ $call->start_date }}</span>
                            </div>
                            <div class="inline-flex items-center gap-4">
                                <span class="icon-[tabler--calendar-minus] size-6"></span>
                                <span class="font-medium">{{ $call->end_date }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col justify-start gap-3">
                            <div class="inline-flex items-center gap-4">
                                <span class="icon-[tabler--school] size-6"></span>
                                <span class="font-medium">{{ $call->career->name }}</span>
                            </div>
                            <div class="inline-flex items-center gap-4">
                                <span class="icon-[tabler--users] size-6"></span>
                                <span class="font-medium">Registros: {{ $registrationCounts[$call->id] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @role('student')
                    <div class="card-footer">
                        @if ($call->status == 'Activo')
                            @php
                                $alreadyApplied =
                                    auth()->user()->userData &&
                                    auth()
                                        ->user()
                                        ->userData->applicationDetails->where('application_calls_id', $call->id)
                                        ->isNotEmpty();
                            @endphp

                            <button wire:click="$emit('openApplicationModal', {{ $call->id }})"
                                class="w-full py-3 h-auto btn btn-primary"
                                @if ($alreadyApplied) disabled @endif>
                                {{ $alreadyApplied ? 'Ya postulado' : 'Postularme' }}
                            </button>
                        @else
                            <button class="w-full py-3 h-auto btn btn-primary" disabled>
                                Postularme
                            </button>
                        @endif
                    </div>
                    @livewire('modals.application-modal')
                @endrole
            </div>
        @endforeach
    </div>
@endif
