<div x-data="{ show: @entangle('isOpen').defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">


    <div class="bg-white rounded-2xl p-6 shadow-xl w-full max-w-lg lg:w-full lg:max-w-3xl">
        <form wire:submit.prevent="save">
            <h2 class="text-xl font-bold mb-4">
                {{ $entityID ? 'Editar Usuario' : 'Nuevo Usuario' }}
            </h2>

            <div class="w-full px-5 py-2 max-h-[30rem] overflow-y-auto">
                <div x-data="{ selectedRole: @entangle('selectedRole') }">
                    <div class="divider divider-default">Datos de Usuario</div>
                    <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                        {{-- Usuario --}}
                        <div class="mb-4">
                            <x-input-label for="username" :value="__('Usuario')" />
                            <x-text-input id="username" wire:model.="formData.username" type="text"
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('formData.username')" class="mt-2" />
                        </div>

                        {{-- Correo --}}
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" wire:model.="formData.email" type="email"
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('formData.email')" class="mt-2" />
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" wire:model.="formData.password" type="password"
                                class="block mt-1 w-full"
                                placeholder="{{ $entityID ? 'Dejar en blanco para mantener la actual' : '' }}" />
                            <x-input-error :messages="$errors->get('formData.password')" class="mt-2" />
                        </div>

                        {{-- Roles --}}
                        <div class="md:mt-1">
                            <x-input-label for="selectedRole" value="Rol del usuario" />
                            <x-select-input wire:model="selectedRole" id="selectedRole"
                                class="w-full rounded border-gray-300">
                                <option value="" hidden selected>Selecciona un rol</option>
                                @foreach ($roles as $id => $name)
                                    <option value="{{ $name }}">{{ ucfirst($name) }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('selectedRole')" class="mt-2" />
                        </div>
                    </div>

                    @if ($selectedRole === 'student')
                        <div>
                            <div class="divider divider-default">Datos Personales</div>
                            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                                {{-- Nombre --}}
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Nombres')" />
                                    <x-text-input id="name" wire:model.="formData.name" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.name')" class="mt-2" />
                                </div>
                                {{-- Apellido --}}
                                <div class="mb-4">
                                    <x-input-label for="lastnames" :value="__('Apellidos')" />
                                    <x-text-input id="lastnames" wire:model.="formData.lastnames" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.lastnames')" class="mt-2" />
                                </div>
                                {{-- Cédula --}}
                                <div class="mb-4">
                                    <x-input-label for="id_card" :value="__('Cédula')" />
                                    <x-text-input id="id_card" wire:model.="formData.id_card" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.id_card')" class="mt-2" />
                                </div>
                                {{-- Celular --}}
                                <div class="mb-4">
                                    <x-input-label for="phone_number" :value="__('Celular')" />
                                    <x-text-input id="phone_number" wire:model.="formData.phone_number" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.phone_number')" class="mt-2" />
                                </div>
                                {{-- Direccion --}}
                                <div class="mb-4">
                                    <x-input-label for="address" :value="__('Domicilio')" />
                                    <x-text-input id="address" wire:model.="formData.address" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.address')" class="mt-2" />
                                </div>
                                {{-- Barrio --}}
                                <div class="mb-4">
                                    <x-input-label for="neighborhood" :value="__('Barrio')" />
                                    <x-text-input id="neighborhood" wire:model.="formData.neighborhood" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.neighborhood')" class="mt-2" />
                                </div>
                                {{-- Jornada --}}
                                <div class="mb-4">
                                    <x-input-label for="daytrip" value="Jornada" />
                                    <x-select-input id="daytrip" wire:model.="formData.daytrip"
                                        class="block w-full rounded border-gray-300">
                                        <option value="" hidden selected>Selecciona una jornada</option>
                                        <option value="Vespertina">Vespertina</option>
                                        <option value="Nocturna">Nocturna</option>
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('formData.daytrip')" class="mt-2" />
                                </div>
                                {{-- Semestre --}}
                                <div class="mb-4">
                                    <x-input-label for="semester" value="Semestre" />
                                    <x-select-input id="semester" wire:model.="formData.semester"
                                        class="block w-full rounded border-gray-300">
                                        <option value="" hidden selected>Selecciona un semestre</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->semester }}
                                            </option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('formData.semester')" class="mt-2" />
                                </div>
                                {{-- Paralelo --}}
                                <div class="mb-4">
                                    <x-input-label for="grade" value="Paralelo" />
                                    <x-select-input id="grade" wire:model.="formData.grade"
                                        class="block w-full rounded border-gray-300">
                                        <option value="" hidden selected>Selecciona un Paralelo</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('formData.grade')" class="mt-2" />
                                </div>
                                {{-- Carrera --}}
                                <div class="mb-4">
                                    <x-input-label for="career" value="Carrera" />
                                    <x-select-input id="career" wire:model.="formData.career"
                                        class="block w-full rounded border-gray-300">
                                        <option value="" hidden selected>Selecciona una Carrera</option>
                                        @foreach ($careers as $career)
                                            <option value="{{ $career->id }}">{{ $career->name }}</option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('formData.career')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (in_array($selectedRole, ['tutor', 'gestor-teacher']))
                        <div>
                            <div class="divider divider-default">Datos Personales</div>
                            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                                {{-- Nombre --}}
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Nombres')" />
                                    <x-text-input id="name" wire:model.="formData.name" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.name')" class="mt-2" />
                                </div>
                                {{-- Apellido --}}
                                <div class="mb-4">
                                    <x-input-label for="lastnames" :value="__('Apellidos')" />
                                    <x-text-input id="lastnames" wire:model.="formData.lastnames" type="text"
                                        class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('formData.lastnames')" class="mt-2" />
                                </div>
                                {{-- Carrera --}}
                                <div class="mb-4 col-span-2">
                                    <x-input-label for="career" value="Carrera" />
                                    <x-select-input id="career" wire:model.="formData.career"
                                        class="block w-full rounded border-gray-300">
                                        <option value="" hidden selected>Selecciona una Carrera</option>
                                        @foreach ($careers as $career)
                                            <option value="{{ $career->id }}">{{ $career->name }}</option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error :messages="$errors->get('formData.career')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    @endif
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
