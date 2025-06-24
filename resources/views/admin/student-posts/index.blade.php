@section('title', 'Postulaciones')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Administrador de Postulaciones') }}
        </h2>
    </x-slot>

    @livewire('filters.posts-filter')
</x-app-layout>
