@if (Auth::user()->id_role == 1)
    @forelse ($applications as $application)
        <div class="rounded-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:mx-8 sm:p-10 lg:mx-8 lg:rounded-3xl">
            <h3 id="tier-hobby" class="text-2xl font-semibold text-blue-600">
                {{ $application->application_title }}</h3>
            <p class="mt-6 text-base/7 text-gray-600">
                <x-application-status :application="$application" />
            </p>
            <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                <li class="flex gap-x-3">
                    <i class="bi bi-calendar"></i>
                    Empieza {{ $application->start_date }}
                </li>
                <li class="flex gap-x-3">
                    <i class="bi bi-calendar"></i>
                    Termina {{ $application->end_date }}
                </li>
            </ul>
            <div>
                <form
                    class="delete-form mt-8 block rounded-md text-center text-sm font-semibold text-white bg-red-800 ring-1 ring-inset ring-red-200 hover:ring-red-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-10"
                    action="{{ route('admin.application-calls.destroy', $application->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w-full px-3.5 py-2.5 text-center text-sm font-semibold" type="submit"
                        class="">Eliminar</button>
                </form>
                @include('components.alert-confirm')
                <a aria-describedby="tier-hobby"
                    class="block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-blue-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-2"
                    href="{{ route('admin.application-calls.edit', $application->id) }}"
                    class="btn btn-primary">Editar</a>
            </div>
        </div>
    @empty
        {{ $slot }}
    @endforelse
@else
    @forelse ($applications as $application)
        <div class="rounded-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:mx-8 sm:p-10 lg:mx-8 lg:rounded-3xl">
            <h3 id="tier-hobby" class="text-2xl font-semibold text-blue-600">
                {{ $application->application_title }}</h3>
            <p class="mt-6 text-base/7 text-gray-600">
                <x-application-status :application="$application" />
            </p>
            <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                <li class="flex gap-x-3">
                    <i class="bi bi-calendar"></i>
                    Empieza {{ $application->start_date }}
                </li>
                <li class="flex gap-x-3">
                    <i class="bi bi-calendar"></i>
                    Termina {{ $application->end_date }}
                </li>
            </ul>
            <a aria-describedby="tier-hobby"
                class="mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-blue-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-8"
                href="{{ route('user.form-register.create', $application->id) }}">{{ __('Postularme') }}</a>
        @empty
            {{ $slot }}
    @endforelse
@endif
