@section('title', __('Nuevo Usuario'))
<x-crud-layout>
    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">{{ __('Crear Usuario') }}
        </h2>
    </div>

    <form action="{{ route('admin.dashboard.user-manager.store') }}" class="p-5" method="POST">
        @csrf

        <div>
            <x-input-label for="name" class="text-gray-900 text-xl font-semibold" :value="__('Usuario')" />
            <x-text-input id="name" name="name" type="text" class="text-gray-900 block mt-1 w-full text-lg"
                :value="old('name')" autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" class="text-gray-900 text-xl font-semibold" :value="__('Correo')" />
            <x-text-input id="email" name="email" type="email" class="text-gray-900 block mt-1 w-full text-lg"
                :value="old('email')" aria-autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" class="text-gray-900 text-xl font-semibold" :value="__('Contraseña')" />
            <x-text-input id="password" name="password" type="password" class="text-gray-900 block mt-1 w-full text-lg"
                :value="old('password')" aria-autocomplete="password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="id_role" class="text-gray-900 text-xl font-semibold" :value="__('Role')" />
            <x-select-input name="id_role" id="id_role" class="text-gray-900 block mt-1 w-full text-lg">
                <option selected disabled>{{ __('Selecciona el rol') }}</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->role_name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('id_role')" class="mt-2" />
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.dashboard.user-manager.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>
</x-crud-layout>
