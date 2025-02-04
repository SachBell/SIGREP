@section('title', 'Panel de Control')
<x-dashboard-layout>
    <div class="mx-4 space-y-5 h-screen">
        <div class="flex">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tigth">
                {{ __('Bienvenido de nuevo ' . auth()->user()->name) }}
            </h2>
        </div>

        <div class="container">
            @if ($applications->isEmpty())
                <p>Aun no hay postulaciones. Intentalo más tarde.</p>
            @else
                @if ($userExist)
                    <p>Ya te has registrado en el proceso de practicas preprofesionales.</p>
                @else
                    <p>Hay postulaciones activas. Puedes verlas en <a class="text-blue-900 hover:text-blue-700 underline"
                            href="{{ route('user.form-register.index') }}">Postularse</a>.</p>
                @endif
            @endif
        </div>
    </div>
</x-dashboard-layout>
