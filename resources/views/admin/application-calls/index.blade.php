@section('title', 'Postulaciones')
<x-dashboard-layout>
    <div class="container-fluid d-flex flex-column justify-content-end mx-0 my-2 gap-4">
        <div class="container-fluid d-flex alifn-items-center px-0">
            <div class="container-fluid w-100">
                <h2>Administrador de Postulaciones</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div id="applicationCardAdmin" class="row mb-3 gap-4 d-flex flex-column">
                    <x-applications-card :applications="$applications">
                        <p>Aún no hay postulaciones activas.</p>
                    </x-applications-card>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
