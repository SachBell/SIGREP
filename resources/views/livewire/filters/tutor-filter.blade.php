<div class="space-y-4">
    @hasanyrole(['admin', 'gestor-teacher'])
        @livewire('modals.assign-students-modal', [], key('assign-students'))
    @endhasanyrole
    <div class="w-full px-2 md:px-8" wire:ignore>
        <!-- Buscador y botón Nuevo Tutor (común) -->
        <div class="w-full grid grid-cols-1">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input w-auto ps-8 focus:border-blue-500 focus:ring-blue-500" wire:model="search"
                    type="text" role="combobox" aria-expanded="false"
                    @if (auth()->user()->hasAnyRole(['admin', 'gestor-teacher'])) placeholder="Buscar Docente" @else placeholder="Buscar estudiante" @endif />
            </div>
        </div>
    </div>

    @hasanyrole(['admin', 'gestor-teacher'])
        <div class="mt-4 space-y-2">
            @if ($studentTutor->isEmpty())
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
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Docente</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Estudiantes A Cargo</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-50">
                            @foreach ($studentTutor as $data)
                                <tr>
                                    @role('admin')
                                        <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                            {{ $data->career->name }}
                                        </td>
                                    @endrole
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        {{ $data->name . ' ' . $data->lastname }}
                                    </td>
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        {{ $data->user->email }}
                                    </td>
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        {{ $data->students_list ?: 'Sin asignaciones' }}
                                    </td>
                                    <td class="flex py-5 space-x-2">
                                        @if (auth()->user()->id === $data->id || auth()->user()->hasRole('admin'))
                                            <button wire:click="$emit('openEdit', {{ $data->id }})"
                                                class="btn btn-circle btn-text btn-sm" aria-label="Editar tutor">
                                                <span class="icon-[tabler--user-plus] size-6"></span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endhasanyrole

    @role('tutor')
        @if (!$hasStudents)
            <div class="card min-h-60 w-full">
                <div class="card-body items-center justify-center">
                    <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                    <span>No hay estudiantes asignados</span>
                </div>
            </div>
        @else
            <div class="px-2 md:px-4 py-8 md:mx-4 space-y-8">
                @foreach ($studentTutor as $tutor)
                    @foreach ($tutor->students_list as $student)
                        <div class="container px-6 py-10 mx-auto shadow rounded-box">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <h1 class="text-xl mb-4">
                                        <span class="font-medium">Estudiante ·</span>
                                        {{ $student['name'] }}
                                    </h1>
                                    <div class="inline-flex flex-col gap-1">
                                        <span class="text-gray-400">
                                            <span class="font-medium">Institución ·</span>
                                            {{ $student['institution'] }}
                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Fecha de Visita ·</span>
                                            {{ $student['date'] }}
                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Hora de Visita ·</span>
                                            {{ $student['time'] }}
                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Visita ·</span>
                                            {{ $student['visits_made'] }} de {{ $student['required_visits'] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="md:col-span-2 md:col-start-3 lg:col-span-2 lg:col-start-4">
                                    <div class="inline-flex flex-col items-center gap-4">
                                        @if ($student['visits_made'] >= $student['required_visits'] && $student['is_complete'])
                                            {{-- Mostrar badge cuando visita convencional completada --}}
                                            <div class="badge badge-soft badge-success h-auto py-2 text-[1rem]">
                                                Visita completada
                                            </div>
                                        @elseif ($student['is_dual'] && $student['visits_made'] >= $student['required_visits'] && $student['second_visit_completed'])
                                            {{-- Mostrar badge cuando dual tiene ambas visitas completas --}}
                                            <div class="badge badge-soft badge-success">
                                                Visitas completadas
                                            </div>
                                        @else
                                            {{-- Si no está completada, mostrar botones --}}
                                            @if ($student['visit_action'] === 'edit')
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="$emit('openEdit', {{ $student['visit_id'] }}, {{ $student['tutor_students_id'] }})">
                                                    <span class="icon-[tabler--calendar-plus] size-6"></span>
                                                    {{ $student['visit_button_text'] }}
                                                </button>

                                                <button wire:click="$emit('openEditVisit', {{ $student['visit_id'] }})">
                                                    Ver detalles
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="$emit('openCreate', {{ $student['tutor_students_id'] }})">
                                                    <span class="icon-[tabler--calendar-plus] size-6"></span>
                                                    {{ $student['visit_button_text'] }}
                                                </button>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endif
    @endrole

</div>
