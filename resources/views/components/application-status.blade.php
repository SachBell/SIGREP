@if ($application->status_call === 1)
    <div class="flex justify-center align-center gap-1">
        <i class="text-xl font-semibold bi bi-check-circle-fill"></i>
        <span class="text-xl font-semibold fw-bold fs-5">Activo</span>
    </div>
@else
    <div class="flex justify-center align-center gap-1">
        <i class="text-xl font-semibold bi bi-dash-circle-fill"></i>
        <span class="text-xl font-base text-muted fs-5">Inactivo</span>
    </div>
@endif
