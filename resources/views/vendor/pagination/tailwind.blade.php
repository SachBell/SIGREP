@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Páginas') }}" class="d-flex align-items-center justify-content-between">
        <div class="d-flex justify-content-between">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 border">
                    {!! __('Anterior') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 border">
                    {!! __('Anterior') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 border">
                    {!! __('Siguiente') !!}
                </a>
            @else
                <span class="px-4 py-2 border">
                    {!! __('Siguiente') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
