@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <!-- Formulario de Estudiantes -->
    <form id="ppForm" class="pt-5 pb-5" action="src/config/App/proccess_form.php" method="POST">
        <div class="input-container container d-flex flex-column gap-5">
            <div class="container-fluid">
                <div class="container-fluid d-flex justify-content-center">
                    <h2 class="fs-1 text-uppercase fw-bold text-center">Marco de Formación 2024 II CDII</h2>
                </div>
                <div class="container mt-4">
                    <p class="description fs-5">
                        ¡Bienvenido al sistema de gestión de prácticas! Este formulario ha sido diseñado para facilitar la
                        coordinación entre los estudiantes y las instituciones que ofrecen oportunidades de prácticas
                        preprofesionales.
                    </p>
                    <p class="description fs-5">
                        A través de este formulario, podrás registrar tus datos personales, seleccionar la institución que
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
                                            <input class="form-control" type="text" name="ci_input"
                                                placeholder="Cédula de Identidad" value="" required>
                                        </div>
                                        <!-- Nombres del Estudiante -->
                                        <div class="container mt-2">
                                            <label for="names_input" class="form-label fs-5"><b class="fw-bold"
                                                    style="color: red;">*</b> Nombres</label>
                                            <input class="form-control" type="text" name="names_input"
                                                placeholder="Nombres" value="" required>
                                        </div>
                                        <!-- Apellidos del Estudiante -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="lastnames_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Apellidos</label>
                                            <input class="form-control" type="text" name="lastnames_input"
                                                placeholder="Apellidos" value="" required>
                                        </div>
                                        <!-- Número de Teléfono -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="celNumber_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Número
                                                Celular</label>
                                            <input class="form-control" type="text" name="celNumber_input"
                                                placeholder="Celular" value="" required>
                                        </div>
                                        <!-- Correo Electrónico -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="email_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Correo</label>
                                            <input class="form-control" type="email" name="email_input"
                                                placeholder="Correo" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- Dirección de Domicilio -->
                                        <div class="container mt-lg-4 mt-2">
                                            <label class="form-label fs-5" for="addressCity_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Domicilio</label>
                                            <input class="form-control" type="text" name="addressCity_input"
                                                placeholder="Dirección Domiciliaria" value="" required>
                                        </div>
                                        <!-- Barrio -->
                                        <div class="container mt-2">
                                            <label class="form-label fs-5" for="neighborhood_input"><b class="fw-bold"
                                                    style="color: red;">*</b> Barrio</label>
                                            <input class="form-control" type="text" name="neighborhood_input"
                                                placeholder="Barrio" value="" required>
                                        </div>
                                        <div class="container mt-2">
                                            <!-- Semestre -->
                                            <div class="mt-2">
                                                <label class="form-label fs-5" for="semester_input"><b class="fw-bold"
                                                        style="color: red;">*</b> Semestre</label>
                                                <select class="form-select" name="semester_input" id="semester" required>
                                                    <option selected disabled>Elige tu Semestre</option>
                                                    <option value="Segundo">Segundo</option>
                                                    <option value="Tercero">Tercero</option>
                                                    <option value="Cuarto">Cuarto</option>
                                                    <option value="Quinto">Quinto</option>
                                                </select>
                                            </div>
                                            <!-- Paralelo -->
                                            <div class="pt-2">
                                                <label class="form-label fs-5" for="grade_input"><b class="fw-bold"
                                                        style="color: red;">*</b> Paralelo</label>
                                                <select class="form-select" name="grade_input" id="grade" required>
                                                    <option selected disabled>Elige tu Semestre</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                            <!-- Jornada -->
                                            <div class="pt-2">
                                                <label class="form-label fs-5" for="dayTrip_input"><b class="fw-bold"
                                                        style="color: red;">*</b> Jornada</label>
                                                <select class="form-select" name="dayTrip_input" id="dayTrip" required>
                                                    <option selected disable>Elige tu Semestre</option>
                                                    <option value="Vespertina">Vespertina
                                                    </option>
                                                    <option value="Nocturna">Nocturna
                                                    </option>
                                                </select>
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
                                    <label class="form-label fs-5" for="entity_input"><b class="fw-bold"
                                            style="color: red;">*</b> Institución</label>
                                    <select class="form-select" name="entity_input" id="entity" required>
                                        <option selected disabled>Selecciona la Institución</option>
                                    </select>
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
@endsection
