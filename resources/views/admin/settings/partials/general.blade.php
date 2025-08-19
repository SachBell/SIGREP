@php
    $settings = \App\Models\GeneralSetting::all()->keyBy('key');
@endphp

<div class="space-y-6">
    <form method="POST" action="{{ route('settings.generalUpdate') }}"
        class="max-w-4xl bg-white border rounded shadow-md p-4 space-y-5">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-semibold mb-4">Configuraciones Generales</h2>
        @if ($hasUpdate)
            <div class="bg-slate-100 py-6 px-5 flex flex-col sm:flex-row justify-between rounded-box gap-5">
                <div class="inline-flex flex-col justify-center gap-2">
                    <span class="font-bold text-xl">¡Nueva versión disponible!</span>
                    <span class="text-md text-gray-500">Actual: v{{ $currentVersion }} | Nueva:
                        v{{ $latestVersion }}</span>
                </div>
                <div class="inline-flex flex-col gap-2">
                    <a href="{{ $changelogUrl }}" target="_blank" class="btn btn-sm">Ver
                        cambios</a>
                    <a href="{{ route('app.update') }}"
                        class="btn btn-sm text-gray-100 bg-blue-600 hover:bg-blue-700 border-none">Actualizar</a>
                </div>
            </div>
        @else
            <div class="text-sm text-gray-500">
                Sistema actualizado — Versión actual: v{{ $currentVersion }}
            </div>
        @endif

        {{-- Sistema --}}
        {{-- <div class="mb-4">
            <x-input-label for="system_name" value="Nombre del Sistema" />
            <x-text-input id="system_name" name="settings[system_name]" type="text" class="mt-1 block w-full"
                value="{{ old('settings.system_name', $settings['system_name']->value ?? '') }}" />
        </div> --}}

        {{-- Modalidad por defecto --}}
        {{-- <div class="mb-4">
            <x-input-label for="default_modality" value="Modalidad por defecto" />
            <x-select-input id="default_modality" name="settings[default_modality]" class="select w-full">
                <option value="dual" @selected(($settings['default_modality']->value ?? '') === 'dual')>Dual</option>
                <option value="convencional" @selected(($settings['default_modality']->value ?? '') === 'convencional')>Convencional</option>
            </x-select-input>
        </div> --}}

        {{-- Límite de estudiantes por entidad --}}
        {{-- <div class="mb-4">
            <x-input-label for="max_students_per_entity" value="Máximo de estudiantes por entidad" />
            <x-text-input id="max_students_per_entity" name="settings[max_students_per_entity]" type="number"
                min="1" class="mt-1 block w-full"
                value="{{ old('settings.max_students_per_entity', $settings['max_students_per_entity']->value ?? '') }}" />
        </div> --}}

        {{-- Visitas dual y convencional --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="dual_visit_count" value="Visitas para modalidad Dual" />
                <x-text-input id="dual_visit_count" name="settings[dual_visit_count]" type="number" min="0"
                    class="mt-1 block w-full"
                    value="{{ old('settings.dual_visit_count', $settings['dual_visit_count']->value ?? '') }}" />
            </div>

            <div>
                <x-input-label for="conv_visits_count" value="Visitas para modalidad Convencional" />
                <x-text-input id="conv_visits_count" name="settings[conv_visits_count]" type="number" min="0"
                    class="mt-1 block w-full"
                    value="{{ old('settings.conv_visits_count', $settings['conv_visits_count']->value ?? '') }}" />
            </div>
        </div>

        {{-- Activar modo mantenimiento --}}
        {{-- <div class="mt-4">
            <label class="max-w-md flex items-center justify-between">
                <span class="ml-2">Activar modo mantenimiento</span>
                <input type="hidden" name="settings[system_maintenance]" value="0">
                <input type="checkbox" name="settings[system_maintenance]" value="1" @checked(($settings['system_maintenance']->value ?? '') == '1')
                    class="switch switch-outline text-[#21356b] border-[#213878] bg-[#1c3a8d] checked:text-[#1d4ed8] checked:border-[#1d4ed8] checked:bg-[#4369d3]">
            </label>
        </div> --}}

        {{-- Límite de estudiantes en convencional --}}

        {{-- <div class="mt-4">
            <label class="max-w-md flex items-center justify-between">
                <span class="ml-2">Límite de estudiantes en convencional</span>
                <input type="hidden" name="settings[conv_agreement_student_limit_enabled]" value="0">
                <input type="checkbox" name="settings[conv_agreement_student_limit_enabled]" value="1"
                    @checked(($settings['conv_agreement_student_limit_enabled']->value ?? '') == '1')
                    class="switch switch-outline text-[#21356b] border-[#213878] bg-[#1c3a8d] checked:text-[#1d4ed8] checked:border-[#1d4ed8] checked:bg-[#4369d3]">
            </label>
        </div> --}}

        <div class="text-end mt-6">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-2">
                    <span class="text-sm text-green-600">{{ session('success') }}</span>
                </div>
            @endif

            <button type="submit"
                class="btn btn-md h-auto py-1.5 bg-blue-800 text-white border-none hover:bg-blue-900">
                Guardar Configuración
            </button>
        </div>
    </form>
</div>
