<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">
    {{-- Caja blanca --}}

    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg">
        <form wire:submit.prevent="save">

            <h2 class="text-xl font-bold mb-4">
                {{ $entityID ? 'Editar Convocatoria' : 'Nueva Convocatoria' }}
            </h2>

            <div class="mb-4">
                <x-input-label for="name" class="text-gray-900 font-semibold" :value="__('Título')" />
                <x-text-input id="name" wire:model.defer="formData.name" type="text"
                    class="text-gray-900 block mt-1 w-full text-lg" autocomplete="name" />
                <x-input-error :messages="$errors->get('formData.name')" class="mt-2" />
            </div>

            <div class="flex justify-between gap-4 mb-4">
                <div class="flex-1">
                    <x-input-label for="start_date" class="text-gray-900 font-semibold" :value="__('Fecha de Inicio')" />
                    <x-text-input id="start_date" wire:model.defer="formData.start_date" type="date"
                        class="text-gray-900 block mt-1 w-full text-lg" autocomplete="start_date" />
                    <x-input-error :messages="$errors->get('formData.start_date')" class="mt-2" />
                </div>

                <div class="flex-1">
                    <x-input-label for="end_date" class="text-gray-900 font-semibold" :value="__('Fecha de Fin')" />
                    <x-text-input id="end_date" wire:model.defer="formData.end_date" type="date"
                        class="text-gray-900 block mt-1 w-full text-lg" autocomplete="end_date" />
                    <x-input-error :messages="$errors->get('formData.end_date')" class="mt-2" />
                </div>
            </div>

            @role('admin')
                <div class="mb-4">
                    <x-input-label for="career" class="text-gray-900 font-semibold" :value="__('Carrera')" />
                    <x-select-input id="career" type="text" class="text-gray-900 block mt-1 w-full text-lg"
                        wire:model.defer="formData.career_id" autocomplete="career">
                        <option value="" selected hidden>Selecciona una Carrera</option>
                        @foreach (\App\Models\Career::all() as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('formData.career_id')" class="mt-2" />
                </div>
            @endrole

            <div class="flex justify-end space-x-2 pt-4">
                <button wire:click="closeModal" type="button" class="…">Cancelar</button>
                <button type="submit" class="…">
                    {{ $entityID ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>
