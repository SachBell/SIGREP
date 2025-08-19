@section('title', 'Informes')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">Generar Informe de Prácticas</h2>
    </x-slot>

    <div class="max-w-7xl py-8 px-6 shadow-md rounded-box">

        <div class="my-4">
            <h2 class="text-xl font-medium">
                Generar Informe
            </h2>
        </div>

        <form action="{{ route('reports.generate') }}" method="POST">
            @csrf

            @livewire('components.report-export-component')

            <div class="mb-4">
                <x-input-label for="format" class="form-label" :value="__('Formato de descarga')" />
                <select name="format" id="format" class="select" required>
                    <option value="">Seleccione tipo</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                </select>
            </div>

            <div class="w-full inline-flex justify-end">
                <button type="submit" class="btn btn-primary">Generar y Descargar</button>
            </div>
        </form>
    </div>
</x-app-layout>
