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
        <div class="container-fluid">
            <div id="applicationCard" class="container d-flex gap-3">
                @forelse ($applications as $app)
                    <div id="applicationContent"
                        class="container d-flex flex-column justify-content-between gap-5 py-4 px-4 rounded">
                        <div class="contianer d-flex flex-column gap-3 px-0">
                            <div class="container-fluid d-flex justify-content-center">
                                <h3 class="fs-3 fw-bold">{{ $app->application_title }}</h3>
                            </div>
                            <div class="container-fluid d-flex justify-content-center gap-2">
                                <span class="fs-6"><b>{{ $app->start_date }}</b> - <b>{{ $app->end_date }}</b></span>
                            </div>
                            <div class="container-fluid d-flex justify-content-center gap-2">
                                <x-application-status :application="$app" />
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-center">
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Postularme</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Aun no hay postulaciones. Intentalo más tarde.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-dashboard-layout>
