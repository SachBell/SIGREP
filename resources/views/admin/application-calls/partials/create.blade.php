@section('title', 'Nueva Postulación')
<x-crud-layout>
    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">
            {{ __('Crear Postulación') }}
        </h2>
    </div>

    <form class="p-5" action="{{ route('admin.application-calls.store') }}" method="POST">
        @csrf

        <div>
            <x-input-label for="application_title" class="text-gray-900 text-xl" :value="__('Nombre')" />
            <x-text-input id="application_title" name="application_title" type="text"
                class="text-gray-900 block mt-1 w-full text-lg" :value="old('application_title')" autocomplete="application_title" placeholder="{{__('Nombre')}}" />
            <x-input-error :messages="$errors->get('application_title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="start_date" class="text-gray-900 text-xl" :value="__('Comienza')" />
            <x-text-input id="start_date" name="start_date" type="date"
                class="text-gray-900 block mt-1 w-full text-lg" :value="old('start_date')" aria-autocomplete="start_date" />
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="end_date" class="text-gray-900 text-xl" :value="__('Termina')" />
            <x-text-input id="end_date" name="end_date" type="date" class="text-gray-900 block mt-1 w-full text-lg"
                :value="old('end_date')" aria-autocomplete="end_date" />
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="status_call" class="text-gray-900 text-xl" :value="__('Estado')" />
            <x-select-input name="status_call" id="status_call" class="text-gray-900 block mt-1 w-full text-lg">
                <option selected disabled>{{ __('Selecciona el estado') }}</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status_call')" class="mt-2" />
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.application-calls.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>
</x-crud-layout>
