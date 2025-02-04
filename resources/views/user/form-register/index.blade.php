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
                <div class="flex items-middle justify-center">
                    @include('user.form-register.partials.status')
                </div>
            @else
                <div id="applicationCardAdmin"
                    class="mx-auto grid max-w-lg grid-cols-1 gap-y-6 items-center sm:mt-20 sm:gap-y-0 lg:max-w-4xl lg:grid-cols-2">
                    <x-applications-card :applications="$applications">
                        <p class="sm:mx-4 lg:mx-4 text-md">Aún no hay postulaciones activas.</p>
                    </x-applications-card>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
