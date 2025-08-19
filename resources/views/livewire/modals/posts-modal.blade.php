<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl p-6 space-y-4 max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold">
            {{ $isEditMode ? 'Editar Postulación' : 'Asignar Estudiantes a Entidad' }}
        </h2>

        @if ($isEditMode && $currentAssignment)
            <div class="mb-4 p-3 bg-blue-50 rounded-md">
                <p class="font-medium">Estudiante:</p>
                <p>{{ $currentAssignment->userData->profiles->name }}
                    {{ $currentAssignment->userData->profiles->lastnames }}</p>
                <p class="text-sm">Carrera: {{ $currentAssignment->userData->careers->name ?? 'N/A' }}</p>
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <x-input-label for="selectedCall" value="Periodo de Postulación" />
                    <x-select-input id="selectedCall" wire:model="selectedCall" class="w-full">
                        <option value="">Seleccione un periodo</option>
                        @foreach ($calls as $call)
                            <option value="{{ $call->id }}" @selected($call->id == $selectedCall)>
                                {{ $call->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('selectedCall')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="selectedEntity" value="Entidad Receptora" />
                    <x-select-input id="selectedEntity" wire:model="selectedEntity" class="w-full">
                        <option value="">Seleccione una entidad</option>
                        @foreach ($entities as $entity)
                            <option value="{{ $entity->id }}" @selected($entity->id == $selectedEntity)>
                                {{ $entity->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('selectedEntity')" class="mt-2" />
                </div>
            </div>

            @if ($selectedEntity)
                <div class="mb-4 p-3 bg-blue-50 rounded-md">
                    <p><strong>Límite de estudiantes:</strong> {{ $maxStudents }}</p>
                    <p><strong>Cupos disponibles:</strong>
                        <span class="{{ $availableSlots <= 0 ? 'text-red-500' : '' }}">
                            {{ $availableSlots }} de {{ $maxStudents }}
                        </span>
                    </p>
                    <p><strong>Dirección:</strong> {{ $this->selectedEntityAddress }}</p>
                </div>
            @endif

            @if (!$isEditMode)
                @if ($students->isNotEmpty())
                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full text-sm border rounded-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left"></th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    @role('admin')
                                        <th class="px-4 py-2 text-left">Carrera</th>
                                    @endrole
                                    <th class="px-4 py-2 text-left">Semestre</th>
                                    <th class="px-4 py-2 text-left">Grado/Paralelo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2">
                                            <input type="checkbox" class="checkbox checkbox-sm"
                                                wire:model="selectedStudents" value="{{ $student->id }}"
                                                @if (
                                                    $student->careers->is_dual &&
                                                        count($selectedStudents) >= $maxStudents &&
                                                        !in_array($student->id, $selectedStudents)) disabled @endif>
                                        </td>
                                        <td class="px-4 py-2">{{ $student->profiles->name ?? '' }}
                                            {{ $student->profiles->lastnames ?? '' }}</td>
                                        @role('admin')
                                            <td class="px-4 py-2">{{ $student->careers->name ?? 'N/A' }}</td>
                                        @endrole
                                        <td class="px-4 py-2">{{ $student->semesters->semester ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $student->grades->grade ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-input-error :messages="$errors->get('selectedStudents')" class="mt-2" />
                    </div>
                @else
                    <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-md">
                        @if ($selectedEntity)
                            No hay estudiantes disponibles para asignar a esta entidad
                        @else
                            Seleccione una entidad para ver los estudiantes disponibles
                        @endif
                    </div>
                @endif
            @endif

            <div class="flex justify-end gap-2 pt-4">
                <button wire:click="closeModal" type="button" class="btn btn-outline">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    @if ($this->shouldDisableSaveButton) disabled @endif>
                    <span wire:loading.class="hidden">
                        {{ $isEditMode ? 'Actualizar Postulación' : 'Guardar Asignaciones' }}
                    </span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
