@if (Auth::user()->hasRole('admin'))
    <div class="flex flex-col gap-8">
        @forelse ($applications as $application)
            <div class="w-full rounded-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:p-10 lg:rounded-3xl">
                <div class="flex flex-col justify-center items-center sm:flex-row sm:justify-end">
                    <div class="sm:flex-1">
                        <h3 id="tier-hobby" class="text-2xl font-semibold text-blue-600">
                            {{ $application->application_title }}</h3>
                    </div>
                    <div class="sm:flex-1 sm:justify-end flex items-center gap-1">
                        <x-application-status :application="$application" />
                    </div>

                </div>
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:flex-1">
                        <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                            <li class="flex gap-2">
                                <span class="icon-[tabler--calendar-check] size-5"></span>
                                Empieza {{ $application->start_date }}
                            </li>
                            <li class="flex gap-2">
                                <span class="icon-[tabler--calendar-minus] size-5"></span>
                                Termina {{ $application->end_date }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <form
                            class="mt-8 block rounded-md text-center text-sm font-semibold text-white bg-red-800 ring-1 ring-inset ring-red-200 hover:ring-red-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-10"
                            action="{{ route('admin.dashboard.applications.destroy', $application->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="w-full px-3.5 py-2.5 text-center text-sm font-semibold" type="submit"
                                class="">Eliminar</button>
                        </form>
                        @include('components.alert-confirm')
                        <a aria-describedby="tier-hobby"
                            class="block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-blue-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-2"
                            href="{{ route('admin.dashboard.applications.edit', $application->id) }}"
                            class="btn btn-primary">Editar</a>
                    </div>
                </div>

            </div>
        @empty
        @endforelse
        <div
            class="flex flex-col justify-center items-center bg-gray-200/75 border-4 border-dotted border-gray-300 h-[250px] rounded-3xl">
            <a href="{{ route('admin.dashboard.applications.create') }}"
                class="btn btn-circle bg-transparent shadow-none border-none size-13">
                <span class="icon-[tabler--circle-plus] size-10 opacity-40"></span>
            </a>
            <span class="opacity-70 mt-4">Crear nuevo proceso</span>
        </div>
    </div>
@else
    @forelse ($applications as $application)
        <div
            class="w-full max-w-xs rounded-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 lg:rounded-3xl">
            <h3 id="tier-hobby" class="text-2xl font-semibold text-blue-600">
                {{ $application->application_title }}</h3>
            <div class="flex items-center justify-center gap-1 mt-4">
                <x-application-status :application="$application" />
            </div>
            <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                <li class="flex gap-2">
                    <span class="icon-[tabler--calendar-check] size-5"></span>
                    Empieza {{ $application->start_date }}
                </li>
                <li class="flex gap-2">
                    <span class="icon-[tabler--calendar-minus] size-5"></span>
                    Termina {{ $application->end_date }}
                </li>
            </ul>
            <a aria-describedby="tier-hobby"
                class="mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-blue-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-8"
                href="{{ route('user.dashboard.forms.create', $application->id) }}">{{ __('Postularme') }}</a>
        </div>
    @empty
        <div class="card min-h-60 w-full">
            <div class="card-body items-center justify-center">
                <span class="icon-[tabler--brand-google-drive] mb-2 size-[5rem] opacity-34"></span>
                <span class="mt-2 text-lg">Actualmente no hay postulaciones activas</span>
            </div>
        </div>
    @endforelse
@endif
