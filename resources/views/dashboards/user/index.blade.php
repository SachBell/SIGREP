@section('title', 'Panel de Control')
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Bienvenido de nuevo') }}
            <span class="text-blue-800">{{ auth()->user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-5 space-y-5">
        @if ($applications->isEmpty())
            <p>Aun no hay postulaciones. Intentalo más tarde.</p>
        @else
            @if ($userExist)
                <p>Ya te has registrado en el proceso de practicas preprofesionales.</p>
            @else
                <p>Hay postulaciones activas. Puedes verlas en <a class="text-blue-900 hover:text-blue-700 underline"
                        href="{{ route('user.dashboard.forms.index') }}">Postularse</a>.</p>
            @endif
        @endif
    </div>
</x-dashboard-layout>
