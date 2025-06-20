@section('title', 'Carreras')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Gestor de Carreras') }}
        </h2>
    </x-slot>

    @livewire('career-filter')
</x-app-layout>
