@section('title', 'Editar Usuario')
<x-crud-layout>
    <div class="py-4 pb-1">
        <h2 class="font-semibold uppercase text-3xl text-gray-900 leading-tigth text-center">{{ __('Editar Usuario') }}</h2>
    </div>

    <form action="{{ route('admin.user-manager.update', $registro->id) }}" class="p-5"
        method="POST">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" class="text-gray-900 text-xl font-semibold" :value="__('Usuario')" />
            <x-text-input id="name" name="name" type="text" class="text-gray-900 block mt-1 w-full text-lg" :value="old('name', $registro->name)"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" class="text-gray-900 text-xl font-semibold" :value="__('Correo')" />
            <x-text-input id="email" name="email" type="email" class="text-gray-900 block mt-1 w-full text-lg" :value="old('email', $registro->email)"
                aria-autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="id_role" class="text-gray-900 text-xl font-semibold" :value="__('Role')" />
            <x-select-input name="id_role" id="id_role" class="text-gray-900 block mt-1 w-full text-lg">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('id_role', $registro->id_role) == $role->id ? 'selected' : '' }}>
                        {{ $role->role_name }}
                    </option>
                @endforeach
            </x-select-input>
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="font-bold text-sm text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.user-manager.index') }}"
                class="font-bold text-sm text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{__('Cancelar')}}
            </x-custom-link-button>
        </div>
    </form>
</x-crud-layout>
