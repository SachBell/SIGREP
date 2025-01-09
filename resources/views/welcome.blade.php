@section('title', 'Inicio')
<x-app-layout>
    <form id="spp-form" class="pt-5 pb-5" action="{{ route('form.store') }}" method="POST">
        @csrf
        <div class="input-container container d-flex flex-column gap-5">
            <div class="container-fluid">
                <div class="container-fluid d-flex justify-content-center">
                    <h2 class="fs-1 text-uppercase fw-bold text-center">Marco de Formación 2024 II CDII</h2>
                </div>
                <div class="container mt-4">
                    <p class="description fs-5">
                        ¡Bienvenido al sistema de gestión de prácticas! Este formulario ha sido diseñado para facilitar
                        la
                        coordinación entre los estudiantes y las instituciones que ofrecen oportunidades de prácticas
                        preprofesionales.
                    </p>
                    <p class="description fs-5">
                        A través de este formulario, podrás registrar tus datos personales, seleccionar la institución
                        que
                        mejor se adapte a tu ubicación y postularte para las prácticas. <b>Ten en cuenta que cada
                            institución cuenta con un límite de plazas disponibles.</b>
                    </p>
                    <span class="fs-5"><b>Los campos marcados con (<b style="color: red;">*</b>) son de carácter
                            obligatorio.</b></span>
                </div>
            </div>
            <div class="container">
                <div class="d-flex flex-column align-items-center gap-5">
                    <div class="container">
                        <fieldset>
                            <div class="container">
                                <legend class="fw-bolder">Datos Personales</legend>
                            </div>
                            <div class="container-fluid d-flex flex-column gap-4">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-lg-6">
                                        <!-- C.I -->
                                        <div class="container mt-4">
                                            <label class="form-label fs-5" for="ci_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Cédula</label>
                                            <input class="form-control @error('cei') is-invalid @enderror"
                                                type="text" id="cei" pattern="[0-9]*" inputmode="numeric"
                                                maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                name="cei" placeholder="Cédula de Identidad"
                                                value="{{ old('cei') }}">
                                            @error('cei')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Nombres del Estudiante -->
                                        <div class="container mt-2">
                                            <label for="names_input" class="form-label fs-5"><b class="fw-bold"
                                                    style="color: red;">*</b> Nombres</label>
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                type="text" name="name" placeholder="Nombres"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Apellidos del Estudiante -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="lastnames_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Apellidos</label>
                                            <input class="form-control @error('lastname') is-invalid @enderror"
                                                type="text" name="lastname" placeholder="Apellidos"
                                                value="{{ old('lastname') }}">
                                            @error('lastname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Número de Teléfono -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="phone_number"><b class="fw-bold"
                                                    style="color: red;">*</b> Número
                                                Celular</label>
                                            <input class="form-control @error('phone_number') is-invalid @enderror"
                                                type="text" name="phone_number" placeholder="Celular"
                                                value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Correo Electrónico -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="email"><b class="fw-bold"
                                                    style="color: red;">*</b> Correo</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" placeholder="Correo"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- Dirección de Domicilio -->
                                        <div class="container mt-lg-4 mt-2">
                                            <label class="form-label fs-5" for="address"><b class="fw-bold"
                                                    style="color: red;">*</b> Domicilio</label>
                                            <input class="form-control @error('address') is-invalid @enderror"
                                                type="text" name="address" placeholder="Dirección Domiciliaria"
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Barrio -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="neighborhood"><b class="fw-bold"
                                                    style="color: red;">*</b> Barrio</label>
                                            <input class="form-control @error('neighborhood') is-invalid @enderror"
                                                type="text" name="neighborhood" placeholder="Barrio"
                                                value="{{ old('neighborhood') }}">
                                            @error('neighborhood')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="container mt-2">
                                            <!-- Semestre -->
                                            <div class="mt-2">
                                                <label class="form-label fs-5" for="id_semester"><b class="fw-bold"
                                                        style="color: red;">*</b> Semestre</label>
                                                <select class="form-select @error('id_semester') is-invalid @enderror"
                                                    name="id_semester" id="id_semester">
                                                    <option selected disabled>Elige tu Semestre</option>
                                                    @foreach ($semesters as $semester)
                                                        <option value="{{ $semester->id }}"
                                                            {{ old('id_semester') == $semester->id ? 'selected' : '' }}>
                                                            {{ $semester->semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_semester')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Paralelo -->
                                            <div class="pt-2">
                                                <label class="form-label fs-5" for="id_grade"><b class="fw-bold"
                                                        style="color: red;">*</b> Paralelo</label>
                                                <select class="form-select @error('id_grade') is-invalid @enderror"
                                                    name="id_grade" id="id_grade">
                                                    <option selected disabled>Elige tu Paralelo</option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}"
                                                            {{ old('id_grade') == $grade->id ? 'selected' : '' }}>
                                                            {{ $grade->grade }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_grade')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Jornada -->
                                            <div class="pt-2">
                                                <label class="form-label fs-5" for="daytrip"><b class="fw-bold"
                                                        style="color: red;">*</b> Jornada</label>
                                                <select class="form-select @error('daytrip') is-invalid @enderror"
                                                    name="daytrip" id="daytrip">
                                                    <option selected disabled>Elige tu Jornada</option>
                                                    <option value="Vespertina"
                                                        {{ old('daytrip') == 'Vespertina' ? 'selected' : '' }}>
                                                        Vespertina
                                                    </option>
                                                    <option value="Nocturna"
                                                        {{ old('daytrip') == 'Nocturna' ? 'selected' : '' }}>Nocturna
                                                    </option>
                                                </select>
                                                @error('daytrip')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="container">
                        <fieldset>
                            <div class="container">
                                <legend class="fw-bolder">Seleccione el lugar de Prácticas</legend>
                            </div>
                            <div class="container d-flex ps-4 pe-4">
                                <!-- Entidad -->
                                <div class="container mt-4">
                                    <label class="form-label fs-5" for="id_institucion"><b class="fw-bold"
                                            style="color: red;">*</b> Institución</label>
                                    <select class="form-select @error('id_institute') is-invalid @enderror"
                                        name="id_institute" id="entity">
                                        <option selected disabled>Selecciona la Institución</option>
                                        @foreach ($entidades as $entidad)
                                            <option value="{{ $entidad->id }}"
                                                {{ 'id_institute', $registro->id_institute ?? '' == $entidad->id ? 'selected' : '' }}>
                                                {{ $entidad->name }} -
                                                {{ $entidad->address }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_institute')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center mt-4">
                <button class="btn-primary ps-4 pe-4 p-2 rounded" type="submit">
                    <span class="fs-4 fw-bolder">Enviar</span>
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
