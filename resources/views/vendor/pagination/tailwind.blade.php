@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between items-center">
        {{-- Número de páginas (lado izquierdo) --}}
        <div class="text-gray-600">
            Página <span class="font-semibold">{{ $paginator->currentPage() }}</span> de <span class="font-semibold">{{ $paginator->lastPage() }}</span>
        </div>

        {{-- Botones de navegación (lado derecho) --}}
        <ul class="flex space-x-2">
            {{-- Botón "Anterior" --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 text-gray-400 cursor-not-allowed btn btn-md disabled">Anterior</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 text-blue-500 hover:text-blue-700 btn btn-md">Anterior</a>
                </li>
            @endif

            {{-- Botón "Siguiente" --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 text-blue-500 hover:text-blue-700 btn btn-md">Siguiente</a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 text-gray-400 cursor-not-allowed btn btn-md disabled">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
