@section('title', 'Nueva Institución')
<x-crud-layout>
    <div id="create-container" class="container-fluid d-flex flex-column align-items-center">
        <div class="container-fluid py-4 pb-2 text-center">
            <h1 class="text-uppercase">Añadir Institución</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="form-container" class="container-fluid">
            <form id="edit-form" class="d-flex flex-column gap-3 py-5 px-5" action="{{ route('admin.institutes.store') }}"
                method="POST">
                @csrf
                <div class="container">
                    <div class="mb-3">
                        <label for="name" class="form-label fs-5">Nombre de la Institución</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fs-5">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ old('address') }}">
                    </div>
                    <div class="mb-3">
                        <label for="user_limit" class="form-label fs-5">Límite de Estudiantes</label>
                        <input type="number" name="user_limit" id="user_limit" class="form-control"
                            value="{{ old('user_limit') }}" pattern="\d*"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" inputmode="numeric">
                    </div>
                </div>
                <div class="mobile container-fluid d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('admin.institutes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-crud-layout>
