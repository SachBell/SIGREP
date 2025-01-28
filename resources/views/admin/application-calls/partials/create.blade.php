@section('title', 'Nueva Postulación')
<x-crud-layout>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="container-fluid py-4 pb-1 text-center">
            <h1 class="text-uppercase">Nueva Postulación</h1>
        </div>
        <div id="form-container" class="contianer-fluid py-4">
            <form id="edit-form" class="py-5 px-5"
                action="{{ route('admin.application-calls.store') }}" method="POST">
                @csrf
                <div class="container-fluid">
                    <div class="mb-3">
                        <label for="application_title" class="form-label fs-5">Nombre de la Postulación</label>
                        <input type="text" name="application_title" id="application_title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label fs-5">Fecha de Inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label fs-5">Fecha de Inicio</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status_call" class="form-label fs-5">Estado de la Postulación</label>
                        <select name="status_call" id="status_call" class="form-control">
                            <option selected disabled>Selecciona el estado</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="mobile container-fluid d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('admin.application-calls.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-crud-layout>
