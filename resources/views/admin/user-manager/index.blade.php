@section('title', 'Gestor de Usuario')
<x-dashboard-layout>
    <div class="container-fluid d-flex flex-column justify-content-end mx-0 my-2">
        <div class="container-fluid px-0 mb-4 d-flex">
            <div class="container-fluid px-0 w-100">
                <h2 class="title-reg my-auto">Gestor de Usuarios</h2>
            </div>
        </div>
        <div class="container-fluid px-0 mb-4">
            <form action="{{ route('admin.user-manager.index') }}" method="GET"
                class="d-flex gap-2 align-items-center">
                <input type="text" name="search" placeholder="Buscar..." class="form-control"
                    value="{{ request()->query('search') }}" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('admin.user-manager.index') }}" class="btn btn-secondary">Resetear</a>
            </form>
        </div>
        <div class="container-fluid table-responsive px-0">
            @if ($registros->isEmpty())
                <span class="fs-5">No se encontraron usarios.</span>
            @else
                <table class="table">
                    <tr>
                        <th class="border col-0 py-0 align-middle">ID</th>
                        <th class="border col-4 align-middle">Nombre de Usuario</th>
                        <th class="border col-2 align-middle">Role</th>
                        <th class="border col-4 align-middle">Correo</th>
                        <th class="border col-4 align-middle">Contraseña</th>
                    </tr>
                    <tbody>
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="border border-gray-300 align-middle">{{ $registro->id }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->name }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->userRole->role_name ?? 'Sin Role' }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->email }}</td>
                                <td class="border border-gray-300 align-middle">
                                    <a href="" class="btn btn-primary btn-sm">Resetear Contraseña</a>
                                </td>
                                <td class="border border-gray-300 align-middle p-0">
                                    <div class="container d-flex gap-3">
                                        <form class="delete-form"
                                            action="{{ route('admin.user-manager.destroy', $registro->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                        </form>
                                        @include('components.alert-confirm')
                                        <a href="{{ route('admin.user-manager.edit', $registro->id) }}"
                                            class="btn btn-primary btn-sm">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-dashboard-layout>
