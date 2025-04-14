@section('title', 'Nuevo Registro')
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">Nuevo Registro</h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="flex">
            <div class="w-full max-w-7xl lg:max-w-4xl mx-auto p-8 bg-gray-100/75 rounded-box shadow-lg">
                <form action="{{ route('admin.dashboard.registers.store') }}" method="POST">
                    @csrf
                    <div class="w-full">
                        <div class="divider text-lg">Estudiante</div>
                        <div class="mt-4">
                            <x-input-label for="id_user" class="text-gray-900 font-semibold" :value="__('Usuario')" />
                            <x-select-input name="id_user" id="id_user" class="text-gray-900 block mt-1 w-full">
                                <option selected disabled>{{ __('Selecciona el rol') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full mt-7">
                        <div class="divider text-lg">Datos del Estudiante</div>
                        <div class="flex mt-4 gap-5">
                            <div class="flex-1">
                                <div>
                                    <x-input-label for="name" class="text-gray-900 font-semibold"
                                        :value="__('Nombres')" />
                                    <x-text-input id="name" name="name" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="cei" class="text-gray-900 font-semibold"
                                        :value="__('Cédula')" />
                                    <x-text-input id="cei" name="cei" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('cei')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="address" class="text-gray-900 font-semibold"
                                        :value="__('Dirección')" />
                                    <x-text-input id="address" name="address" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="id_semester" class="text-gray-900 font-semibold"
                                        :value="__('Semestre')" />
                                    <x-select-input name="id_semester" id="id_semester" class="mt-1 w-full">
                                        <option selected disabled>{{ __('Selecciona tu semestre') }}</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ old('id_semester') == $semester->id ? 'selected' : '' }}>
                                                {{ $semester->semester }}
                                            </option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('id_semester')" />
                                </div>
                            </div>
                            <div class="flex-1">
                                <div>
                                    <x-input-label for="lastname" class="text-gray-900 font-semibold"
                                        :value="__('Apellidos')" />
                                    <x-text-input id="lastname" name="lastname" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="phone_number" class="text-gray-900 font-semibold"
                                        :value="__('Teléfono')" />
                                    <x-text-input id="phone_number" name="phone_number" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="neighborhood" class="text-gray-900 font-semibold"
                                        :value="__('Barrio')" />
                                    <x-text-input id="neighborhood" name="neighborhood" type="text"
                                        class="text-gray-900 block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="id_grade" class="text-gray-900 font-semibold"
                                        :value="__('Paralelo')" />
                                    <x-select-input name="id_grade" id="id_grade" class="mt-1 w-full">
                                        <option selected disabled>{{ __('Selecciona tu paralelo') }}</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{ old('id_grade') == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->grade }}
                                            </option>
                                        @endforeach
                                    </x-select-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('id_grade')" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="daytrip" class="text-gray-900 font-semibold" :value="__('Jornada')" />
                            <x-select-input name="daytrip" id="daytrip" class="mt-1 w-full">
                                <option selected disabled>{{ __('Selecciona tu jornada') }}</option>
                                <option value="Vespertina" {{ old('daytrip') == 'Vespertina' ? 'selected' : '' }}>
                                    Vespertina
                                </option>
                                <option value="Nocturna" {{ old('daytrip') == 'Nocturna' ? 'selected' : '' }}>
                                    Nocturna
                                </option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('daytrip')" />
                        </div>
                    </div>
                    <div class="w-full mt-7">
                        <div class="divider text-lg">Entidad De Prácticas</div>
                        <div class="flex mt-4 gap-5" x-data="{
                            selectedInstitute: '',
                            institutes: {{ $institutes->toJson() }}
                        }">
                            <div class="flex-1">
                                <x-input-label class="text-gray-900 font-semibold" for="id_institute" :value="__('Institución')" />
                                <x-select-input name="id_institute" id="id_institute" class="mt-1 w-full"
                                    x-model="selectedInstitute">
                                    <option value="" disabled selected>Seleccione una institución</option>
                                    @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}">
                                            {{ $institute->name }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('id_institute')" />
                            </div>
                            <div class="flex-1">
                                <x-input-label class="text-gray-900 font-semibold" for="institute_address"
                                    :value="__('Dirección')" />
                                <input
                                    class="text-gray-900 block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    id="institute_address" name="institute_address" :value="__($institute->address)"
                                    x-model="selectedInstitute ? (institutes.find(i => i.id == selectedInstitute)?.address || '') : ''"
                                    disabled />
                                <x-input-error class="mt-2" :messages="$errors->get('institute_address')" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-12">
                        <button class="btn btn-md text-white bg-blue-900 border-none shadow-lg hover:bg-blue-950"
                            type="submit">
                            {{ __('Guardar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
