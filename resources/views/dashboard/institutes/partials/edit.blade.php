<x-crud-layout>
    @section('title', 'Editar Registro')
    @section('content')
        <div class="container-fluid d-flex flex-column align-items-center">
            <div class="container-fluid py-4 pb-1 text-center">
                <h1 class="text-uppercase">Editar Institución</h1>
            </div>
            <div id="form-container" class="contianer-fluid py-4">
                <form id="edit-form" class="py-5 px-5" action="{{ route('dashboard.institutes.update', $registro->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="name" class="form-label fs-5">Nombre de la Institución</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $registro->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fs-5">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $registro->address) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_limit" class="form-label fs-5">Límite de Usuarios</label>
                            <input type="number" name="user_limit" id="user_limit" class="form-control"
                                value="{{ old('user_limit', $registro->user_limit) }}" required>
                        </div>
                    </div>

                    <div class="mobile container-fluid d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <a href="{{ route('dashboard.institutes.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection

</x-crud-layout>
