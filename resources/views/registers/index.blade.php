@extends('layouts.dashboard')
@section('title', 'Registros')
@section('content')
    <div class="container-fluid d-flex mt-1 mb-5">
        <div class="container-fluid d-flex justify-content-center py-2 w-100">
            <h2 class="title-reg my-auto">Registros de Practicas Preprofesionales ISUS 2024-II</h2>
        </div>
        <div class="d-flex justify-content-center align-items-center py-2">
            <button id="toggle-btn" class="btn btn-primary mx-3">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        <div class="container-fluid">
            <form action="{{ route('registros.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                <input type="text" name="search" placeholder="Buscar..." class="form-control"
                    value="{{ request()->query('search') }}" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('registros.index') }}" class="btn btn-secondary">Resetear</a>
            </form>
        </div>

        <div class="container-fluid table-responsive">
            @if ($registros->isEmpty())
                <span class="fs-5">No se encontraron Registros.</span>
            @else
                <table id="reg-table" class="table">
                    <tr>
                        <th class="border px-1 align-middle">ID</th>
                        <th class="border px-5 align-middle">CEI</th>
                        <th class="border px-5 align-middle">Nombres</th>
                        <th class="border px-5 align-middle">Apellidos</th>
                        <th class="border px-5 align-middle">Celular</th>
                        <th class="border px-5 align-middle">Correo</th>
                        <th class="border px-5 align-middle">Dirección</th>
                        <th class="border px-5 align-middle">Barrio</th>
                        <th class="border px-4 align-middle">Semestre</th>
                        <th class="border px-2 align-middle">Paralelo</th>
                        <th class="border px-4 align-middle">Jornada</th>
                        <th class="border px-5 align-middle">Institución</th>
                        <th class="border px-5 align-middle">Dirección Institución</th>
                        <th class="border px-4 align-middle">Registro</th>
                        <th class="border px-4 align-middle">Modificación</th>
                    </tr>
                    <tbody>
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="border border-gray-300 align-middle">{{ $registro->id }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->cei }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->name }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->lastname }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->phone_number }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->email }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->address }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->neighborhood }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->semester }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->grade }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->daytrip }}</td>
                                <td class="border border-gray-300 align-middle">
                                    {{ $registro->institucion->name ?? 'Sin Asignar' }}
                                </td>
                                <td class="border border-gray-300 align-middle">
                                    {{ $registro->institucion->address ?? 'Sin Asignar' }}
                                </td>
                                <td class="border border-gray-300 align-middle">{{ $registro->created_at }}</td>
                                <td class="border border-gray-300 align-middle">{{ $registro->updated_at }}</td>
                                <td class="border border-gray-300">
                                    <form class="delete-form mb-2" action="{{ route('registros.destroy', $registro->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                    </form>
                                    @include('components.alert-confirm')
                                    <a href="{{ route('registros.edit', $registro->id) }}"
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
        <a href="{{ route('registros.export') }}" class="btn btn-success">Descargar Registros</a>

    </div>
@endsection
