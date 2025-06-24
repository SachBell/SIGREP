<div x-data="{ show: @entangle('isOpen') }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex justify-center bg-black/50" style="display: none;">

    <div class="bg-white rounded-xl shadow-xl h-fit w-full max-w-3xl p-6 mt-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Postulación a {{ $selectedCall->name ?? '' }}</h2>
        </div>

        <form wire:submit.prevent="save">
            <div class="space-y-4">
                <div>
                    <x-input-label for="fullname" :value="__('Nombre Completo')" />
                    <x-text-input id="fullname" class="w-full" :value="$userFullname" disabled />
                </div>

                <div>
                    <x-input-label for="institute" :value="__('Institución')" />
                    <x-select-input wire:model="selectedInstitute" id="institute" class="w-full" required>
                        <option value="" hidden selected>Seleccione una institución</option>
                        @foreach ($institutes as $institute)
                            <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('selectedInstitute')" class="mt-2" />

                </div>

                <div>
                    <x-input-label for="address" :value="__('Dirección')" />
                    <x-text-input id="address" class="w-full" :value="$this->instituteAddress" disabled />
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <button type="button" wire:click="closeModal" class="btn btn-secondary">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    Enviar Postulación
                </button>
            </div>
        </form>
    </div>
</div>
