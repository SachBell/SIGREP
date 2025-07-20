@section('title', 'Convocatorias')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Convocatorias para Practicas Preprofesionles') }}
        </h2>
    </x-slot>

    @livewire('modals.call-modal')

    <div class="flex flex-col gap-8">
        <div class="flex justify-end">
            <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                <span class="icon-[tabler--apps] size-5"></span>
                {{ __('Nueva Convocatoria') }}
            </button>
        </div>
        <div>
            @livewire('filters.call-card-filter')
        </div>
    </div>
</x-app-layout>
