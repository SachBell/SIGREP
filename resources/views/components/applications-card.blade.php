@if (Auth::user()->id_role == 1)
    @forelse ($applications as $application)
        <div class="flex flex-center border">
            <div class="flex flex-col justify-between mb-3 py-4 px-3 h-100">
                <div class="flex justify-center">
                    <h3>{{ $application->application_title }}</h3>
                </div>
                <div class="flex justify-center gap-2">
                    <span>{{ $application->start_date }} - {{ $application->end_date }}</span>
                </div>
                <div class="flex justify-center gap-2">
                    <x-application-status :application="$application" />
                </div>
                <div class="flex justify-center gap-3 py-2">
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
    <div id="applicationCard" class="flex gap-3">
        @forelse ($applications as $app)
            <div id="applicationContent" class="flex flex-col justify-between gap-5 py-4 px-4 rounded">
                <div class="flex flex-col gap-3 px-0">
                    <div class="flex justify-center">
                        <h3 class="text-2xl font-bold">{{ $app->application_title }}</h3>
                    </div>
                    <div class="flex justify-center gap-2">
                        <span class="text-md"><b>{{ $app->start_date }}</b> - <b>{{ $app->end_date }}</b></span>
                    </div>
                    <div class="flex justify-center gap-2">
                        <x-application-status :application="$app" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <x-link-button link="{{ route('user.form-register.create', $app->id) }}">
                        {{ __('Postularme') }}
                    </x-link-button>
                </div>
            </div>
        @empty
            {{ $slot }}
        @endforelse
    </div>
@endif
