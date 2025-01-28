@section('title', 'Postulaciones')
<x-dashboard-layout>
    <div class="mx-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
                {{ __('Registrar Practicas Preprofesionales') }}
            </h2>
        </x-slot>

        <div class="py-12">
            @if ($userExist)
                @include('user.form-register.partials.status')
            @else
                <x-applications-card :applications="$applications">
                    <p>Aun no hay postulaciones. Intentalo más tarde.</p>
                </x-applications-card>
            @endif
        </div>
    </div>
</x-dashboard-layout>
