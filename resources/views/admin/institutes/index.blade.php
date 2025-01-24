@section('title', 'Institutos')
<x-dashboard-layout>
    <div class="container-fluid d-flex mb-5">
        <div class="container-fluid d-flex justify-content-center py-2 w-100">
            <h2 class="title-reg my-auto">Instituciones para Practicas Preprofesionales ISUS 2024-II</h2>
        </div>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        <div class="container-fluid">
            <form action="{{ route('admin.institutes.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                <input type="text" name="search" placeholder="Buscar..." class="form-control"
                    value="{{ request()->query('search') }}" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('admin.institutes.index') }}" class="btn btn-secondary">Resetear</a>
            </form>
        </div>

        <div class="container-fluid table-responsive">
            @if ($registros->isEmpty())
                <span class="fs-5">No se encontraron Registros.</span>
            @else
                <table id="reg-table" class="table">
                    <tr>
                        <th class="border px-1 align-middle">ID</th>
                        <th class="border px-5 align-middle">Nombre</th>
                        <th class="border px-5 align-middle">Dirección</th>
                        <th class="border px-5 align-middle">Límite de Usuarios</th>
                        <th class="border px-4 align-middle">Registro</th>
                        <th class="border px-4 align-middle">Modificación</th>
                    </tr>
                    <tbody>
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="border border-gray-300 align-middle">{{ $registro->id }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->name }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->address }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->user_limit }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->created_at }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->updated_at }}</td>
                                <td class="border border-gray-300">
                                    <form class="delete-form mb-2"
                                        action="{{ route('admin.institutes.destroy', $registro->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                    </form>
                                    @include('components.alert-confirm')
                                    <a href="{{ route('admin.institutes.edit', $registro->id) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- Paginación -->
        <div class="container-fluid d-flex justify-content-center mt-4">
            {{ $registros->links() }}
        </div>
    </div>

    <div class="container-fluid">
        <div class="container-fluid">
            <h2>Nueva Institución</h2>
            <p>
                Añade nuevas instituciones en las cuales podras definir el número exacto de cupos que puede tener.
            </p>
        </div>
        <div class="container-fluid">
            <a class="btn btn-primary" href="{{ route('admin.institutes.create') }}">Añadir Institución</a>
        </div>
    </div>
</x-dashboard-layout>
