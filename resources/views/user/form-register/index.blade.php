@section('title', 'Postulaciones')
<x-dashboard-layout>
    <div class="container-fluid d-flex flex-column justify-content-end px-0 my-2 gap-4">
        <div class="d-flex alifn-items-center px-0">
            <div class="container-fluid w-100">
                <h2>Registrar Practicas Preprofesionales</h2>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button id="toggle-btn" class="btn btn-primary mx-3">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="">
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
