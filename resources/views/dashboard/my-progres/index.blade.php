@section('title', 'Mi Progreso')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Mi Progreso') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        {{-- Sección: Información general --}}
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">Información General</h2>
            <p><strong>Estudiante:</strong> {{ $user->name . ' ' . $user->lastnames ?? 'N/A' }}</p>
            <p><strong>Carrera:</strong> {{ $user->userData->careers->name ?? 'N/A' }}</p>
            <p><strong>Período:</strong> {{ $currentPeriod->name ?? 'No asignado' }}</p>
        </div>

        {{-- Sección: Estado de postulación o práctica --}}
        @if ($application)
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Estado Actual</h2>
                <p><strong>Institución:</strong> {{ $application->receivingEntities->name ?? 'N/A' }}</p>
                <p><strong>Estado:</strong>
                    <span
                        class="inline-block px-2 py-1 text-sm rounded-full
                        {{ $application->status_individual === 'Finalizado' ? 'bg-green-100 text-green-800' : ($application->status_individual === 'En Progreso' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ $application->status_individual }}
                    </span>
                </p>
            </div>
            {{-- Sección: Documentos --}}
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Documentos</h2>
                <ul class="list-disc pl-6">
                    <li>
                        <a href="https://tecnologicosucre.edu.ec/web/practicas-pre-profesionales/" target="blank"
                            class="text-blue-600 hover:underline">
                            {{ __('Formatos para descargar') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Sección: Evaluación final --}}
            @if ($finalGrade)
                <div class="bg-white shadow rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-2">Calificación Final</h2>
                    <p class="text-2xl font-bold text-green-600">{{ $finalGrade->score }}/100</p>
                    <p class="text-gray-700">Observaciones: {{ $finalGrade->comment ?? 'Ninguna' }}</p>
                </div>
            @endif

            {{-- Sección: Línea de tiempo (timeline) --}}
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Línea de Tiempo</h2>
                <ol class="relative border-l border-gray-200">
                    @foreach ($timeline as $item)
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute w-3 h-3 bg-blue-500 rounded-full -left-1.5 border border-white"></span>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item['title'] }}</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                                {{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y') }}
                            </time>
                            <p class="mb-4 text-base font-normal text-gray-600">{{ $item['description'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        @else
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Estado Actual</h2>
                <p class="text-gray-500">Aún no te has registrado en una institución.</p>
            </div>
        @endif
    </div>

</x-app-layout>
