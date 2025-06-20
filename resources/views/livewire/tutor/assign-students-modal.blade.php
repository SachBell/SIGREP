<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 my-0" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl p-6 space-y-4 max-h-[100vh] overflow-y-auto">
        <h2 class="text-xl font-semibold">
            {{ $entityID ? 'Editar asignación de estudiantes' : 'Asignar estudiantes' }}
        </h2>

        @if ($entityID && $model)
            <div class="bg-blue-50 p-3 rounded-md mb-4">
                <p class="font-medium">Docente:</p>
                <p>{{ $model->name }}</p>
                @role('admin')
                    <p class="text-sm text-gray-600">Carrera: {{ $model->career->name ?? 'Sin carrera asignada' }}</p>
                @endrole
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <div class="text-sm text-gray-500">
                Mostrando {{ $students->count() }} estudiantes
                @if (auth()->user()->hasRole('gestor-teacher'))
                    (de su carrera)
                @endif
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="selectAll" class="checkbox checkbox-sm" wire:model="selectAll">
                <label for="selectAll">Seleccionar todos</label>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border rounded-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2"></th>
                            @role('admin')
                                <th class="px-4 py-2">Carrera</th>
                            @endrole
                            <th class="px-4 py-2">Cédula</th>
                            <th class="px-4 py-2">Nombres y Apellidos</th>
                            <th class="px-4 py-2">Semestre</th>
                            <th class="px-4 py-2">Paralelo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <input type="checkbox" class="checkbox checkbox-sm" wire:model="selectedStudents"
                                        value="{{ $student->id }}">
                                </td>
                                @role('admin')
                                    <td class="px-4 py-2">
                                        {{ $student->userData->careers->name ?? 'Sin carrera' }}
                                    </td>
                                @endrole
                                <td class="px-4 py-2">
                                    {{ $student->id_card }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $student->name }} {{ $student->lastnames }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $student->userData->semesters->semester ?? 'Sin semestre' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $student->userData->grades->grade ?? 'Sin grado' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                                    No hay estudiantes disponibles para asignar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($errors->any())
                <div class="mt-4 bg-red-50 text-red-700 p-3 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end gap-2 mt-4">
                <button wire:click="closeModal" type="button" class="btn btn-outline">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    @disabled($this->shouldDisableSaveButton)>
                    <span wire:loading.class="hidden">
                        {{ __('Guardar Asignaciones') }}
                    </span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
