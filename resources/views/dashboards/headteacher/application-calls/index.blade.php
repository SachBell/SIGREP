@section('title', 'Gestor de Postulaciones')
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Administrador de Postulaciones') }}
        </h2>
    </x-slot>

    <div class="py-5 space-y-5">
        <div class="">
            <div class="w-full">
                <x-applications-card :applications="$applications" />
            </div>
        </div>
    </div>
</x-dashboard-layout>
