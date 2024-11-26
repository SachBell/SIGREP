<x-crud-layout>
    @section('title', 'Editar Registro')
    @section('content')
        <div class="container-fluid d-flex flex-column align-items-center">
            <div class="container-fluid py-4 pb-1 text-center">
                <h1 class="text-uppercase">Editar Registro</h1>
            </div>
            <div id="form-container" class="contianer-fluid py-4">
                <form id="edit-form" class="py-5 px-5" action="{{ route('registros.update', $registro->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <fieldset class="mb-4">
                        <div class="container-fluid mb-3">
                            <legend>
                                <h2>Datos Personales</h2>
                            </legend>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="cei" class="form-label fs-5 ">CEI</label>
                                        <input type="text" name="cei" id="cei" class="form-control"
                                            value="{{ old('cei', $registro->cei) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label fs-5 ">Nombres</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $registro->name) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastname" class="form-label fs-5 ">Apellidos</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control"
                                            value="{{ old('lastname', $registro->lastname) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label fs-5 ">Celular</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            value="{{ old('phone_number', $registro->phone_number) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label fs-5 ">Correo</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ old('email', $registro->email) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label fs-5 ">Dirección</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ old('address', $registro->address) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="neighborhood" class="form-label fs-5 ">Barrio</label>
                                        <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                            value="{{ old('neighborhood', $registro->neighborhood) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="semester" class="form-label fs-5 ">Semestre</label>
                                        <select name="semester" id="semester" class="form-select">
                                            <option value="Segundo"
                                                {{ old('semester', $registro->semester) == 'Segundo' ? 'selected' : '' }}>
                                                Segundo</option>
                                            <option value="Tercero"
                                                {{ old('semester', $registro->semester) == 'Tercero' ? 'selected' : '' }}>
                                                Tercero</option>
                                            <option value="Cuarto"
                                                {{ old('semester', $registro->semester) == 'Cuarto' ? 'selected' : '' }}>
                                                Cuarto</option>
                                            <option value="Quinto"
                                                {{ old('semester', $registro->semester) == 'Quinto' ? 'selected' : '' }}>
                                                Quinto</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="grade" class="form-label fs-5 ">Paralelo</label>
                                        <select name="grade" id="grade" class="form-select">
                                            <option value="A"
                                                {{ old('grade', $registro->grade) == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B"
                                                {{ old('grade', $registro->grade) == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C"
                                                {{ old('grade', $registro->grade) == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D"
                                                {{ old('grade', $registro->grade) == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="daytrip" class="form-label fs-5 ">Jornada</label>
                                        <select name="daytrip" id="daytrip" class="form-select">
                                            <option value="Vespertina"
                                                {{ old('grade', $registro->daytrip) == 'Vespertina' ? 'selected' : '' }}>
                                                Vespertina
                                            </option>
                                            <option value="Nocturna"
                                                {{ old('grade', $registro->daytrip) == 'Nocturna' ? 'selected' : '' }}>
                                                Nocturna
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mb-4">
                        <div class="container">
                            <legend>
                                <h2>Lugar de Practicas</h2>
                            </legend>
                        </div>
                        <div class="container">
                            <div class="mb-3">
                                <label for="id_institucion" class="form-label fs-5 ">Institución</label>
                                <select name="id_institucion" id="id_institucion" class="form-select">
                                    @foreach ($instituciones as $institucion)
                                        <option value="{{ $institucion->id }}"
                                            {{ $institucion->id == $registro->id_institucion ? 'selected' : '' }}>
                                            {{ $institucion->name }} - {{ $institucion->address }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <div class="container-fluid d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <a href="{{ route('registros.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection

</x-crud-layout>
