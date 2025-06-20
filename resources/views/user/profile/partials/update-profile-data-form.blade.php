<section class="w-full">
    <header>
        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('Información Personal') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualiza la información de tu perfil, para tus futuras postulaciones.') }}
        </p>
    </header>

    <x-form-input :userData="$userData" :semesters="$semesters" :grades="$grades"></x-form-input>

</section>
