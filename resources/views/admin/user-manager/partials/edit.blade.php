@section('title', 'Editar Usuario')
<x-crud-layout>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="container-fluid py-4 pb-1 text-center">
            <h1 class="text-uppercase">Editar Usuario</h1>
        </div>
        <div id="form-container" class="user-edit container-fluid py-4">
            <form action="{{ route('admin.user-manager.update', $registro->id) }}" id="edit-form" class="py-5 px-5 custom-py"
                method="POST">
                @csrf
                @method('PUT')

                <div class="form-floating my-4">
                    <input id="name" name="name" type="text" class="form-control"
                        value="{{ old('name', $registro->name) }}" placeholder="Username">
                    <label for="name">Usuario</label>
                </div>

                <div class="form-floating mb-4">
                    <input id="email" name="email" type="email" class="form-control"
                        value="{{ old('email', $registro->email) }}" placeholder="Correo">
                    <label for="email">Correo</label>
                </div>
                <div class="form-floating mb-5 p-0">
                    <select name="id_role" id="id_role" class="form-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('id_role', $registro->id_role) == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="id_role">Escoge un role</label>
                </div>

                <div class="mobile container-fluid d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('admin.user-manager.index') }}" class="mobile btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-crud-layout>
