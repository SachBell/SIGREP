@section('title', 'Postulaciones')
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Registrar Practicas Preprofesionales') }}
        </h2>
    </x-slot>

    <div class="py-5 space-y-5">
        @if ($userExist)
            <div class="flex items-middle justify-center">
                @include('user.form-register.partials.status')
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 justify-items-center lg:grid-cols-3">
                <x-applications-card :applications="$applications" />
            </div>
        @endif
    </div>
</x-dashboard-layout>
