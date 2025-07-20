@section('title', 'Convocatorias')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Convocatorias para Practicas Preprofesionles') }}
        </h2>
    </x-slot>

    <div class="flex flex-col gap-8">
        <div>
            @if ($calls->isEmpty())
                <span>No hay datos</span>
            @else
                @livewire('filters.call-card-filter')
            @endif
        </div>
    </div>
</x-app-layout>
