<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">


    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg lg:w-full lg:max-w-3xl">
        <form wire:submit.prevent="save">
            <h2 class="text-xl font-bold mb-4">
                {{ $entityID ? 'Editar Visita' : 'Agendar Visita' }}
            </h2>

            <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                <div>
                    <label class="block font-medium mb-1">Fecha</label>
                    <input type="date" wire:model.defer="formData.date" class="input w-full">
                    @error('formData.date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Hora</label>
                    <input type="time" step="1" wire:model.defer="formData.time" class="input w-full">
                    @error('formData.time')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- Botones --}}
            <div class="flex justify-end space-x-2 pt-4">
                <button wire:click="closeModal" type="button"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    Cancelar
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    {{ $entityID ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>
