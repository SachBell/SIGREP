@php
    if (auth()->user()->hasRole('admin')) {
        $pageTitle = 'Administrador de Tutores';
    } elseif (auth()->user()->hasRole('gestor-teacher')) {
        $pageTitle = 'Gestión Tutores';
    } elseif (auth()->user()->hasRole('tutor')) {
        $pageTitle = 'Estudiantes Asignados';
    } else {
        $pageTitle = 'Panel de Tutores';
    }
@endphp
@section('title', $pageTitle)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            @role('admin')
                {{ __('Administrador de Tutores') }}
                @elserole('gestor-teacher')
                {{ __('Gestión Tutores') }}
                @elserole('tutor')
                {{ __('Estudiantes Asignados') }}
            @endrole
        </h2>
    </x-slot>

    @livewire('filters.tutor-filter')
</x-app-layout>
