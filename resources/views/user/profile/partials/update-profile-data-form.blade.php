<section>
    <div>
        <h2>
            {{ __('Información Personal') }}
        </h2>
        <p class="mt-1">
            {{ __('Actualiza la información de tu perfil, para tus futuras postulaciones.') }}
        </p>
    </div>

    <x-form-input :userData="$userData" :semesters="$semesters" :grades="$grades"></x-form-input>

</section>
