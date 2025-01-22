@section('title', 'Panel de Control')
<x-dashboard-layout>
    <div class="container-fluid d-flex flex-column justify-content-end px-0 my-2 gap-4">
        <div class="container-fluid d-flex alifn-items-center px-0">
            <div class="container-fluid w-100">
                <h2>Bienvenido de nuevo {{ auth()->user()->name }}</h2>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button id="toggle-btn" class="btn btn-primary mx-3">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="container">
            @if ($applications->isEmpty())
                <p>Aun no hay postulaciones. Intentalo más tarde.</p>
            @else
                @if ($userExist)
                    <p>Ya te has registrado en el proceso de practicas preprofesionales.</p>
                @else
                    <p>Hay postulaciones activas. Puedes verlas en <a
                            href="{{ route('user.form-register.index') }}">Postularse</a>.</p>
                @endif
            @endif
        </div>
    </div>
</x-dashboard-layout>
