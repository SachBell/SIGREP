<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">

    
    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg">
        <form wire:submit.prevent="save">
            <h2 class="text-xl font-bold mb-4">
                {{ $entityID ? 'Editar Carrera' : 'Nueva Carrera' }}
            </h2>

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre de la Carrera')" />
                <x-text-input id="name" wire:model.defer="formData.name" type="text"
                    class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('formData.name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="is_dual" class="inline-flex items-center">
                    <input type="checkbox" id="is_dual" wire:model.defer="formData.is_dual"
                        class="rounded border-gray-300 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-gray-700">¿Carrera Dual?</span>
                </label>
                <x-input-error :messages="$errors->get('formData.is_dual')" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <button wire:click="closeModal" type="button" class="…">Cancelar</button>
                <button type="submit" class="…">{{ $entityID ? 'Actualizar' : 'Guardar' }}</button>
            </div>
        </form>
    </div>
</div>
