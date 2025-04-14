<div class="w-4/5 bg-white space-y-10 px-[6rem] py-[6rem] border rounded-2xl shadow-2xl">
    @if ($applicationDetails)
        <div class="text-center text-gray-800 space-y-4">
            <h2 class="font-semibold text-3xl">Periodo de Postulación</h2>
            <div class="w-full flex items-center justify-center space-x-4">
                <span class="text-xl font-bold">Periodo:</span>
                <span class="text-xl">
                    {{ $applicationDetails->applicationCalls?->application_title ?: 'N/A' }}
                </span>
            </div>
            <div class="w-full flex items-center justify-center space-x-4">
                <span class="text-xl font-bold">Estado:</span>
                <span class="text-xl capitalize">
                    {{ $applicationDetails->status_individual }}
                </span>
            </div>
            <div class="w-full flex space-x-5 items-middle justify-center">
                <div class="items-middle">
                    <i class="bi bi-calendar-fill text-lg mr-2"></i>
                    <span class="text-lg">
                        {{ $applicationDetails->applicationCalls?->start_date ?: 'N/A' }}
                    </span>
                </div>
                <div class="items-middle">
                    <i class="bi bi-calendar-fill text-lg mr-2"></i>
                    <span class="text-lg">
                        {{ $applicationDetails->applicationCalls?->end_date ?: 'N/A' }}
                    </span>
                </div>
            </div>
        </div>

        <h2 class="font-semibold text-3xl text-gray-800">Datos del Estudiante</h2>

        <div class="flex flex-col ">
            <div class="flex space-x-5">
                <div class="w-full">
                    <div>
                        <x-input-label class="text-gray-900 text-xl" for="cei" :value="__('Cédula')" />
                        <x-text-input type="text" name="cei" id="cei" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->cei }}" disabled readonly />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="text-gray-900 text-xl" for="name" :value="__('Nombres')" />
                        <x-text-input type="text" name="name" id="name" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->name }}" disabled readonly />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="text-gray-900 text-xl" for="semester" :value="__('Semestre')" />
                        <x-text-input type="text" name="semester" id="semester" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->semesters->semester }}" disabled readonly />
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <x-input-label class="text-gray-900 text-xl" for="phone_number" :value="__('Celular')" />
                        <x-text-input type="text" name="phone_number" id="phone_number" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->phone_number }}" disabled readonly />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="text-gray-900 text-xl" for="lastname" :value="__('Apellidos')" />
                        <x-text-input type="text" name="lastname" id="lastname" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->lastname }}" disabled readonly />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="text-gray-900 text-xl" for="daytrip" :value="__('Jornada')" />
                        <x-text-input type="text" name="daytrip" id="daytrip" class="w-full opacity-75"
                            value="{{ $applicationDetails->userData->daytrip }}" disabled readonly />
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <x-input-label class="text-gray-900 text-xl" for="daytrip" :value="__('Paralelo')" />
                <x-text-input type="text" name="grade" id="grade" class="w-full opacity-75"
                    value="{{ $applicationDetails->userData->grades->grade }}" disabled readonly />
            </div>
        </div>

        <h2 class="font-semibold text-3xl text-gray-800">Lugar de Prácticas</h2>

        <div class="w-full flex space-x-5">
            <div class="w-full">
                <x-input-label class="text-gray-900 text-xl" for="istitute_name" :value="__('Institución')" />
                <x-text-input type="text" name="istitute_name" id="istitute_name" class="w-full opacity-75"
                    value="{{ $applicationDetails->institutes->name }}" disabled readonly />
            </div>
            <div class="w-full">
                <x-input-label class="text-gray-900 text-xl" for="istitute_address" :value="__('Dirección')" />
                <x-text-input type="text" name="istitute_address" id="istitute_address" class="w-full opacity-75"
                    value="{{ $applicationDetails->institutes->address }}" disabled readonly />
            </div>
        </div>

        <div class="w-full flex pt-10 items-center justify-center">
            <a href="{{ route('user.dashboard.request.preview', $applicationDetails->id) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-900 focus:bg-blue-700 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Descargar
                Registro</a>
        </div>
    @else
        <p>No se encontraron datos para mostrar.</p>
    @endif
</div>
