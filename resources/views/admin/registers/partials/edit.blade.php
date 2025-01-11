@section('title', 'Editar Registro')
<x-crud-layout>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="container-fluid py-4 pb-1 text-center">
            <h1 class="text-uppercase">Editar Registro</h1>
        </div>
        <div id="form-container" class="form-edit contianer-fluid py-4">
            <form id="edit-form" class="py-5 px-5 custom-py" action="{{ route('admin.registros.update', $registro->id) }}"
                method="POST">
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
                                        value="{{ old('cei', $registro->cei) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fs-5 ">Nombres</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $registro->name) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="lastname" class="form-label fs-5 ">Apellidos</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname', $registro->lastname) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label fs-5 ">Celular</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                        value="{{ old('phone_number', $registro->phone_number) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fs-5 ">Correo</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ old('email', $registro->email) }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label fs-5 ">Dirección</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ old('address', $registro->address) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="neighborhood" class="form-label fs-5 ">Barrio</label>
                                    <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                        value="{{ old('neighborhood', $registro->neighborhood) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="semester" class="form-label fs-5 ">Semestre</label>
                                    <select name="id_semester" id="semester" class="form-select">
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ old('id_semester', $registro->id_semester) == $semester->id ? 'selected' : '' }}>
                                                {{ $semester->semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="grade" class="form-label fs-5 ">Paralelo</label>
                                    <select name="id_grade" id="grade" class="form-select">
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{ old('id_grade', $registro->id_grade) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->grade }}
                                            </option>
                                        @endforeach
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
                            <select name="id_institute" id="entity" class="form-select">
                                @foreach ($entidades as $entidad)
                                    <option value="{{ $entidad->id }}"
                                        {{ old('id_institute', $id_institute) == $entidad->id ? 'selected' : '' }}>
                                        {{ $entidad->name }} - {{ $entidad->address }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>

                <div class="mobile container-fluid d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('admin.registros.index') }}" class="mobile btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</x-crud-layout>
