@if ($userData)
    <form action="{{ route('user.dashboard.profile.dataUpdate') }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" :value="__('Nombres')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $userData->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Apellidos')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $userData->lastname)"
                required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="cei" :value="__('Cédula')" />
            <x-text-input id="cei" name="cei" type="text" class="mt-1 block w-full" :value="old('cei', $userData->cei)"
                required autofocus autocomplete="cei" />
            <x-input-error class="mt-2" :messages="$errors->get('cei')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Celular')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                :value="old('phone_number', $userData->phone_number)" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Domicilio')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $userData->address)"
                required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="neighborhood" :value="__('Barrio')" />
            <x-text-input id="neighborhood" name="neighborhood" type="text" class="mt-1 block w-full"
                :value="old('neighborhood', $userData->neighborhood)" required autofocus autocomplete="neighborhood" />
            <x-input-error class="mt-2" :messages="$errors->get('neighborhood')" />
        </div>

        <div>
            <x-input-label for="semester" :value="__('Semestre')" />
            <x-select-input name="id_semester" id="semester" class="mt-1 block w-full">
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}"
                        {{ old('id_semester', $userData->id_semester) == $semester->id ? 'selected' : '' }}>
                        {{ $semester->semester }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('semester')" />
        </div>

        <div>
            <x-input-label for="grade" :value="__('Paralelo')" />
            <x-select-input name="id_grade" id="grade" class="mt-1 block w-full">
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}"
                        {{ old('id_grade', $userData->id_grade) == $grade->id ? 'selected' : '' }}>
                        {{ $grade->grade }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('grade')" />
        </div>

        <div>
            <x-input-label for="daytrip" :value="__('Jornada')" />
            <x-select-input name="daytrip" id="daytrip" class="mt-1 block w-full">
                <option value="Vespertina" {{ old('daytrip', $userData->daytrip) == 'Vespertina' ? 'selected' : '' }}>
                    Vespertina
                </option>
                <option value="Nocturna" {{ old('daytrip', $userData->daytrip) == 'Nocturna' ? 'selected' : '' }}>
                    Nocturna
                </option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('daytrip')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'data-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Datos Actualizados.') }}</p>
            @endif
        </div>
    </form>
@else
    <form action="{{ route('user.dashboard.profile.dataStore') }}" method="POST" class="mt-6">
        @csrf

        <div class="w-full flex gap-5">
            <div class="flex-1">
                <div>
                    <x-input-label for="name" :value="__('Nombres')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="lastname" :value="__('Apellidos')" />
                    <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full"
                        :value="old('lastname')" required autofocus autocomplete="lastname" />
                    <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="cei" :value="__('Cédula')" />
                    <x-text-input id="cei" name="cei" type="text" class="mt-1 block w-full"
                        :value="old('cei')" required autofocus autocomplete="cei" />
                    <x-input-error class="mt-2" :messages="$errors->get('cei')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="phone_number" :value="__('Celular')" />
                    <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                        :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                </div>
            </div>
            <div class="flex-1">
                <div>
                    <x-input-label for="address" :value="__('Domicilio')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                        :value="old('address')" required autofocus autocomplete="address" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="neighborhood" :value="__('Barrio')" />
                    <x-text-input id="neighborhood" name="neighborhood" type="text" class="mt-1 block w-full"
                        :value="old('neighborhood')" required autofocus autocomplete="neighborhood" />
                    <x-input-error class="mt-2" :messages="$errors->get('neighborhood')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="semester" :value="__('Semestre')" />
                    <x-select-input name="id_semester" id="semester" class="mt-1 w-full">
                        <option selected disabled>{{ __('Selecciona tu semestre') }}</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}"
                                {{ old('id_semester') == $semester->id ? 'selected' : '' }}>
                                {{ $semester->semester }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="grade" :value="__('Paralelo')" />
                    <x-select-input name="id_grade" id="grade" class="mt-1 w-full">
                        <option selected disabled>{{ __('Selecciona tu paralelo') }}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}"
                                {{ old('id_grade') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->grade }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                </div>
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="daytrip" :value="__('Jornada')" />
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

        <div class="mt-8 flex items-center gap-4">
            @if (session('status') === 'data-create')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Datos Actualizados.') }}</p>
            @endif
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
        </div>
    </form>
@endif
