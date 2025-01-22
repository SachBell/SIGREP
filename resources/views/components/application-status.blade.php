@if ($application->status_call === 1)
    <div class="container d-flex justify-content-center align-items-center gap-1">
        <i class="fa-solid fa-circle active"></i>
        <span class="fw-bold fs-5">Activo</span>
    </div>
@else
    <div class="container d-flex justify-content-center align-items-center gap-1">
        <i class="fa-solid fa-circle disable"></i>
        <span class="text-muted fs-5">Inactivo</span>
    </div>
@endif
