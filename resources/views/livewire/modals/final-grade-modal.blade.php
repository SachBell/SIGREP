<div x-data="{ show: @entangle('isOpen') }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">
    <div class="bg-white rounded-xl shadow-xl h-fit w-full max-w-3xl p-6 mt-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Calificar Estudiante</h2>
        </div>

        @if ($errorMessage)
            <div class="alert alert-warning mb-4">{{ $errorMessage }}</div>
        @endif

        @if (count($visitHistory))
            <div class="my-6">
                <h3 class="text-lg font-semibold mb-2">Historial de Visitas</h3>
                <div class="overflow-x-auto">
                    <table class="table w-full table-zebra">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Observación</th>
                                <th>Tutor</th>
                                <th class="text-center">Completada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitHistory as $visit)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($visit['date'])->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit['time'])->format('H:i') }}</td>
                                    <td class="text-wrap">{{ $visit['observation'] ?? '—' }}</td>
                                    <td>{{ $visit['tutor'] }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-soft {{ $visit['is_complete'] ? 'badge-success' : 'badge-error' }}">
                                            {{ $visit['is_complete'] ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="save">
            <input type="hidden" wire:model="tutorStudentId">
            <label class="label">
                <span class="label-text">Calificación (0-10)</span>
            </label>
            <input type="text" min="0" max="10" maxlength="2"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2)" wire:model.defer="grade"
                class="input input-bordered w-full" />

            <label class="label mt-4">
                <span class="label-text">Observaciones</span>
            </label>
            <textarea wire:model.defer="observations" class="textarea textarea-bordered w-full"></textarea>

            <div class="mt-4 flex justify-end gap-2">
                <button type="button" class="btn btn-outline" wire:click="closeModal">Cancelar</button>
                <button type="submit" class="btn btn-primary"
                    @if (!$canBeRated) disabled @endif>Guardar</button>
            </div>
        </form>
    </div>
    <div class="modal-backdrop" wire:click="closeModal"></div>
</div>
