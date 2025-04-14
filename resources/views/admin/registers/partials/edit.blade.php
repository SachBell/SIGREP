@section('title', 'Editar Registro')
<x-dashboard-layout>
    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">{{ __('Editar Registro') }}
        </h2>
    </div>
    <form class="p-5" action="{{ route('admin.dashboard.registers.update', $registro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex flex-col space-y-1">
            <div class="container-fluid mb-3">
                <fieldset class="border-t">
                    <legend align="center" class="text-xl">
                        {{ __('Datos Personales') }}
                    </legend>
                </fieldset>
            </div>
            <div
                class="w-full mb-4 flex flex-col items-center space-y-5 sm:flex-col sm:space-y-5 sm:space-x-0 md:flex-row md:space-x-5">

                <div class="w-full">
                    <div class="mt-4">
                        <x-input-label for="cei" class="text-gray-900 text-lg" :value="__('CEI')" />
                        <x-text-input type="text" name="cei" id="cei"
                            class="text-gray-900 block mt-1 w-full" :value="old('cei', $registro->cei)" autocomplete="cei" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" class="text-gray-900 text-lg" :value="__('Nombres')" />
                        <x-text-input type="text" name="name" id="name"
                            class="text-gray-900 block mt-1 w-full" value="{{ old('name', $registro->name) }}"
                            autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="lastname" class="text-gray-900 text-lg" :value="__('Apellidos')" />
                        <x-text-input type="text" name="lastname" id="lastname"
                            class="text-gray-900 block mt-1 w-full"
                            value="{{ old('lastname', $registro->lastname) }}" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone_number" class="text-gray-900 text-lg" :value="__('Celular')" />
                        <x-text-input type="text" name="phone_number" id="phone_number"
                            class="text-gray-900 block mt-1 w-full"
                            value="{{ old('phone_number', $registro->phone_number) }}" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" class="text-gray-900 text-lg" :value="__('Correo')" />
                        <x-text-input type="text" name="email" id="email"
                            class="text-gray-900 block mt-1 w-full"
                            value="{{ old('email', $registro->user->email) }}" />
                    </div>
                </div>

                <div class="w-full">

                    <div>
                        <x-input-label for="address" class="text-gray-900 text-lg" :value="__('Dirección')" />
                        <x-text-input type="text" name="address" id="address"
                            class="text-gray-900 block mt-1 w-full" value="{{ old('address', $registro->address) }}" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="neighborhood" class="text-gray-900 text-lg" :value="__('Barrio')" />
                        <x-text-input type="text" name="neighborhood" id="neighborhood"
                            class="text-gray-900 block mt-1 w-full"
                            value="{{ old('neighborhood', $registro->neighborhood) }}" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="semester" class="text-gray-900 text-lg" :value="__('Semestre')" />
                        <x-select-input name="id_semester" id="semester"
                            class="text-gray-900 block mt-1 w-full text-lg">
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}"
                                    {{ old('id_semester', $registro->id_semester) == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->semester }}
                                </option>
                            @endforeach
                        </x-select-input>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="grade" class="text-gray-900 text-lg" :value="__('Paralelo')" />
                        <x-select-input name="id_grade" id="grade" class="text-gray-900 block mt-1 w-full text-lg">
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"
                                    {{ old('id_grade', $registro->id_grade) == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->grade }}
                                </option>
                            @endforeach
                        </x-select-input>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="daytrip" class="text-gray-900 text-lg" :value="__('Jornada')" />
                        <x-select-input name="daytrip" id="daytrip" class="text-gray-900 block mt-1 w-full text-lg">
                            <option value="Vespertina"
                                {{ old('daytrip', $registro->daytrip) == 'Vespertina' ? 'selected' : '' }}>
                                Vespertina
                            </option>
                            <option value="Nocturna"
                                {{ old('daytrip', $registro->daytrip) == 'Nocturna' ? 'selected' : '' }}>
                                Nocturna
                            </option>
                        </x-select-input>
                    </div>
                </div>
            </div>
            <div>
                <fieldset class="border-t mt-4">
                    <legend align="center" class="text-xl">
                        {{ __('Lugar de Practicas') }}
                    </legend>
                </fieldset>
            </div>
            <div>
                <div>
                    <x-input-label for="id_institucion" class="text-gray-900 text-lg" :value="__('Institución')" />
                    <x-select-input name="id_institute" id="entity" class="text-gray-900 block mt-1 w-full text-lg">
                        @foreach ($entidades as $entidad)
                            <option value="{{ $entidad->id }}"
                                {{ old('id_institute', $id_institute) == $entidad->id ? 'selected' : '' }}>
                                {{ $entidad->name }} - {{ $entidad->address }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
            </div>
        </div>

        <div class="flex justify-center align-middle mt-8 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.dashboard.registers.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>


</x-dashboard-layout>
