@section('title', 'Convenios')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Lista de Convenios - Instituciones Receptoras') }}
        </h2>
    </x-slot>

    @livewire('convenant-filter')
</x-app-layout>
