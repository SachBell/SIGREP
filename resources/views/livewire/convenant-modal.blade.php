<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">


    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg">
        <form wire:submit.prevent="save">
            <h2 class="text-xl font-bold mb-4">
                {{ $entityID ? 'Editar Convenio' : 'Nuevo Convenio' }}
            </h2>
            <div class="max-h-[30rem] overflow-y-auto px-5">

                <div class="divider">Datos del Director</div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Nombres del Director --}}
                    <div class="mb-4">
                        <x-input-label for="director_name" :value="__('Nombres')" />
                        <x-text-input id="director_name" wire:model.defer="formData.director_name" type="text"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.director_name')" class="mt-2" />
                    </div>
                    {{-- Apellidos del Director --}}
                    <div class="mb-4">
                        <x-input-label for="director_lastname" :value="__('Apellidos')" />
                        <x-text-input id="director_lastname" wire:model.defer="formData.director_lastname"
                            type="text" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.director_lastname')" class="mt-2" />
                    </div>
                    {{-- Cédula del Director --}}
                    <div class="mb-4">
                        <x-input-label for="director_id_card" :value="__('Cédula')" />
                        <x-text-input id="director_id_card" wire:model.defer="formData.director_id_card" type="text"
                            maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.director_id_card')" class="mt-2" />
                    </div>
                    {{-- Correo del Director --}}
                    <div class="mb-4">
                        <x-input-label for="director_email" :value="__('Correo')" />
                        <x-text-input id="director_email" wire:model.defer="formData.director_email" type="text"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.director_email')" class="mt-2" />
                    </div>
                    {{-- Teléfono del Director --}}
                    <div class="mb-4 col-span-2">
                        <x-input-label for="director_phone_number" :value="__('Teléfono')" />
                        <x-text-input id="director_phone_number" wire:model.defer="formData.director_phone_number"
                            type="text" maxlength="10" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.director_phone_number')" class="mt-2" />
                    </div>
                </div>

                <div class="divider">Datos de la Institución</div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Nombre --}}
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" wire:model.defer="formData.name" type="text"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.name')" class="mt-2" />
                    </div>

                    {{-- Direccion --}}
                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Dirección')" />
                        <x-text-input id="address" wire:model.defer="formData.address" type="text"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.address')" class="mt-2" />
                    </div>

                    {{-- Limite de Usuarios --}}
                    <div class="mb-4">
                        <x-input-label for="user_limit" :value="__('Limite de Usuarios')" />
                        <x-text-input id="user_limit" wire:model.defer="formData.user_limit" type="text"
                            maxlength="5" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.user_limit')" class="mt-2" />
                    </div>

                    {{-- Sector P. --}}
                    <div class="mb-4">
                        <x-input-label for="productive_sector" :value="__('Sector Productivo')" />
                        <x-text-input id="productive_sector" wire:model.defer="formData.productive_sector"
                            type="text" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.productive_sector')" class="mt-2" />
                    </div>

                    {{-- Inicio del Convenio --}}
                    <div class="mb-4">
                        <x-input-label for="convenant_start_date" :value="__('Inicio del Convenio')" />
                        <x-text-input type="date" id="convenant_start_date"
                            wire:model.defer="formData.convenant_start_date" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.convenant_start_date')" class="mt-2" />
                    </div>

                    {{-- Fin del Convenio --}}
                    <div class="mb-4">
                        <x-input-label for="convenant_end_date" :value="__('Fin del Convenio')" />
                        <x-text-input type="date" id="convenant_end_date"
                            wire:model.defer="formData.convenant_end_date" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('formData.convenant_end_date')" class="mt-2" />
                    </div>

                    @role('admin')
                        {{-- Fin del Convenio --}}
                        <div class="mb-4 col-span-2">
                            <x-input-label for="career_id" :value="__('Fin del Convenio')" />
                            <x-select-input id="career_id" wire:model.defer="formData.career_id"
                                class="block w-full rounded border-gray-300">
                                <option value="" hidden selected>Selecciona una Carrera</option>
                                @foreach ($careers as $career)
                                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('formData.career_id')" class="mt-2" />
                        </div>
                    @endrole

                    {{-- Observaciones --}}
                    <div class="mb-4 col-span-2">
                        <x-input-label for="observations" :value="__('Observaciones')" />
                        <textarea class="resize-none textarea max-w-xl" wire:model.defer="formData.observations" id="observations"></textarea>
                        <x-input-error :messages="$errors->get('formData.observations')" class="mt-2" />
                    </div>
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
