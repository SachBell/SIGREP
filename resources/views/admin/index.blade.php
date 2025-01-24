@section('title', 'Panel de Control')
<x-dashboard-layout>
    <div class="container-fluid d-flex justify-content-end mx-0 my-2">
        <div class="col-12 w-100">
            <h2>Bienvenido de nuevo {{ auth()->user()->name }}</h2>
        </div>
    </div>
</x-dashboard-layout>
