@section('title', 'Postularse')
<x-crud-layout>

    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">
            {{ __('Formulario de postulación') }}</h2>

        <p class="text-lg text-center mt-4"><b class="text-gray-800">Convocatoria:</b>
            {{ $application->application_title }}</p>
        <p class="text-lg text-center mt-2 mb-4"><b class="text-gray-800">Periodo:</b> {{ $application->start_date }} -
            {{ $application->end_date }}</p>
    </div>

    <form class="p-5" action="{{ route('user.dashboard.forms.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_application_calls" value="{{ $application->id }}">

        <div>
            <x-input-label for="user_name" class="text-gray-900 text-xl" :value="__('Estudiante')" />
            <x-text-input type="text" class="text-gray-900 block mt-1 w-full text-lg" id="user_name"
                value="{{ $user->name ?? '' }}" readonly />
        </div>

        <div class="mt-4">
            <x-input-label class="text-gray-900 text-xl" for="id_institute" :value="__('Selecciona la institución')" />
            <x-select-input name="id_institute" id="id_institute" class="text-gray-900 block mt-1 w-full text-lg"
                required>
                @foreach ($institutes as $institute)
                    <option value="{{ $institute->id }}">
                        {{ $institute->name }} - {{ $institute->address }}
                    </option>
                @endforeach
            </x-select-input>
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('user.dashboard.forms.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>
</x-crud-layout>
