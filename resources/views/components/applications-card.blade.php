@if (Auth::user()->id_role == 1)
    @forelse ($applications as $application)
        <div class="col-md-12 col-sm-12 col-lg-5 border">
            <div class="d-flex flex-column justify-content-between mb-3 py-4 px-3 h-100">
                <div class="container-fluid d-flex justify-content-center">
                    <h3>{{ $application->application_title }}</h3>
                </div>
                <div class="container-fluid d-flex justify-content-center gap-2">
                    <span>{{ $application->start_date }} - {{ $application->end_date }}</span>
                </div>
                <div class="container-fluid d-flex justify-content-center gap-2">
                    <x-application-status :application="$application" />
                </div>
                <div class="container-fluid d-flex justify-content-center gap-3 py-2">
                    <form class="delete-form" action="{{ route('admin.application-calls.destroy', $application->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    @include('components.alert-confirm')
                    <a href="{{ route('admin.application-calls.edit', $application->id) }}"
                        class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>
    @empty
        {{ $slot }}
    @endforelse
@else
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
                    <a href="{{ route('user.form-register.create', $app->id) }}" class="btn btn-primary">Postularme</a>
                </div>
            </div>
        @empty
            {{ $slot }}
        @endforelse
    </div>
@endif
