@section('title', 'Nueva Institución')
<x-dashboard-layout>
    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">
            {{ __('Añadir Institución') }}
        </h2>
    </div>

    <form id="edit-form" class="d-flex flex-column gap-3 py-5 px-5" action="{{ route('admin.dashboard.institutes.store') }}"
        method="POST">
        @csrf

        <div>
            <x-input-label for="name" class="text-gray-900 text-xl" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="text-gray-900 block mt-1 w-full text-lg"
                value="{{ old('name') }}" autocomplete="name" placeholder="{{ __('Nombre') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="address" class="text-gray-900 text-xl" :value="__('Dirección')" />
            <x-text-input id="address" name="address" type="text" class="text-gray-900 block mt-1 w-full text-lg"
                value="{{ old('address') }}" autocomplete="address" placeholder="{{ __('Dirección') }}" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="user_limit" class="text-gray-900 text-xl" :value="__('Límite de Usuarios')" />
            <x-text-input id="user_limit" name="user_limit" type="number"
                class="text-gray-900 block mt-1 w-full text-lg" value="{{ old('user_limit') }}"
                autocomplete="user_limit" pattern="\d*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                inputmode="numeric" placeholder="{{ __('Límite de Usuarios') }}" />
            <x-input-error :messages="$errors->get('user_limit')" class="mt-2" />
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.dashboard.institutes.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>
</x-dashboard-layout>
