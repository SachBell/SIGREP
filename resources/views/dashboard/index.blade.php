@section('title', 'Inicio')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Bienvenido de nuevo ' . auth()->user()->name) }}
        </h2>
    </x-slot>
</x-app-layout>
