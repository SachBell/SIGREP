<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">

    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Detalles de Visita</h2>

        <div class="space-y-4">
            <div>
                <x-input-label for="date" :value="__('Fecha')"/>
                <x-text-input type="date" wire:model.defer="formData.date" disabled class="input w-full disabled" />
            </div>

            <div>
                <x-input-label for="time" :value="__('Hora')"/>
                <x-text-input type="time" wire:model.defer="formData.time" disabled class="input w-full disabled" />
            </div>

            <div>
                <x-input-label for="observations" :value="__('Observaciones')"/>
                <textarea wire:model.defer="formData.observation" rows="4" class="textarea w-full"></textarea>
                <x-input-error :messages="$errors->get('formData.observations')" class="mt-2" />
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model.defer="formData.is_complete" id="completed" class="checkbox checkbox-sm checkbox-primary" />
                <x-input-label for="complete" :value="__('Visita completada')"/>
                <x-input-error :messages="$errors->get('formData.is_complete')" class="mt-2" />

            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <button wire:click="closeModal" type="button"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                Cancelar
            </button>

            <button wire:click="save" type="button"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Guardar cambios
            </button>
        </div>
    </div>
</div>
