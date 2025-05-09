@section('title', 'Editar Role')
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Editar el role ') }}
            <span class="text-blue-900">{{ $role->name }}</span>
        </h2>
    </x-slot>

    <form action="{{ route('admin.dashboard.rolespermissions.update', $role->id) }}" class="p-5" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-4">
            <x-input-label for="role_name" class="text-gray-900 text-xl font-semibold" :value="__('Nombre')" />
            <x-text-input id="role_name" name="role_name" type="role_name"
                class="text-gray-900 block mt-1 w-full text-lg" :value="old('role_name', $role->name)" aria-autocomplete="role_name" />
            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <div class="divider mt-12 mb-12">
                <span class="text-2xl">Permisos</span>
            </div>
            <div>
                @foreach ($permissions as $permission)
                    <div class="max-w-sm flex items-center justify-between">
                        <label for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                        <input name="permissions[]" id="perm-{{ $permission->id }}" type="checkbox"
                            value="{{ $permission->name }}"
                            {{ in_array($permission->name, old('permissions', $permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                    </div>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
        </div>

        <div class="flex justify-center align-middle mt-6 space-x-4">
            <x-custom-button
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:bg-blue-200 active:bg-blue-500">
                {{ __('Guardar') }}
            </x-custom-button>
            <x-custom-link-button link="{{ route('admin.dashboard.rolespermissions.index') }}"
                class="px-4 py-2 font-bold text-sm sm:text-sm md:text-lg text-white bg-red-700 hover:bg-red-800 focus:bg-blue-800 active:bg-red-900">
                {{ __('Cancelar') }}
            </x-custom-link-button>
        </div>
    </form>
</x-dashboard-layout>
