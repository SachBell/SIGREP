@section('title', 'Administrador de Usuarios')
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Administrador de Usuarios') }}
        </h2>
    </x-slot>

    @livewire('users-filter')

</x-app-layout>
