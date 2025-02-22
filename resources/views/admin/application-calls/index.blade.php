@section('title', 'Postulaciones')
<x-dashboard-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Administrador de Postulaciones') }}
        </h2>
    </x-slot>

    <div class="py-5 space-y-5">
        <div class="mx-auto">
            <div id="applicationCardAdmin"
                class="mx-auto grid max-w-lg grid-cols-1 gap-y-6 items-center sm:mt-20 sm:gap-y-0 lg:max-w-4xl lg:grid-cols-2">
                <x-applications-card :applications="$applications">
                    <p class="sm:mx-4 lg:mx-4 text-md">Aún no hay postulaciones activas.</p>
                </x-applications-card>
            </div>
        </div>
        <div class="mx-w-7x1 mx-auto sm:px-4 lg:px-4 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-5">
                <div>
                    <h2 class="text-3xl font-medium text-gray-900">
                        {{ __('Nuevo Proceso') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Añade nuevos procesos de postulación.') }}
                    </p>
                </div>
                <div>
                    <x-custom-link-button link="{{ route('admin.dashboard.applications.create') }}"
                        class="px-4 py-2 font-bold text-sm text-white bg-blue-800 hover:bg-blue-900 focus:bg-blue-700 active:bg-blue-800">
                        {{ __('Crear Proceso') }}
                    </x-custom-link-button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
