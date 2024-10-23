<?php

    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;
    
    $fileEntity = 'src/DataBase/db_istituciones.xlsx';

    // Cargar el archivo de Excel de instituciones y direcciones
    if (file_exists($fileEntity)) {
        $spreadsheetInstituciones = IOFactory::load($fileEntity);
    } else {
        die("No se encontro el archivo");
    }
    $sheetInstituciones = $spreadsheetInstituciones->getActiveSheet();
    $instituciones = [];
    $lastRowInstituciones = $sheetInstituciones->getHighestRow();

    for ($row=2; $row <= $lastRowInstituciones; $row++) {

        $institucion = $sheetInstituciones->getCell("A$row")->getValue();
        $direccion = $sheetInstituciones->getCell("B$row")->getValue();
        $fullEntity = $institucion . ' - ' . $direccion;
        $instituciones[] = ['name' => $institucion, 'direccion' => $direccion, 'entityInfo' => $fullEntity];
    }
    // Verificar si hay un mensaje en la URL
    $mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">ISUS SPP</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/" aria-current="page">Inicio
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid mt-5">
        <!-- Formulario de Estudiantes -->
        <form action="src/config/App/proccess_form.php" method="POST">
            <div class="input-container container d-flex flex-column gap-4">
                <div class="container-fluid d-flex justify-content-center">
                    <h1>Selección de Prácticas Preprofecionales</h1>
                </div>
                <div class="container">
                    <p id="mensaje" style="display: <?= $mensaje === '' ? 'none' : 'block' ?>;">
                        <?= htmlspecialchars($mensaje) ?>
                    </p>
                    <script>
                        window.onload = function () {
                            const mensajeElement = document.getElementById('mensaje');
                            if (mensajeElement.style.display === 'block') {
                                setTimeout(function () {
                                    mensajeElement.style.display = 'none';
                                }, 5000);
                            }
                        };
                    </script>
                </div>
                <div class="container">
                    <div class="d-flex flex-column align-items-center gap-5">
                        <div class="container">
                            <fieldset>
                                <legend class="text-center">Datos Personales</legend>
                                <div class="container d-flex flex-column gap-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <!-- C.I -->
                                            <div class="container mt-4">
                                                <label class="form-label fs-5" for="ci_input">Cédula</label>
                                                <input class="form-control" type="text" name="ci_input"
                                                    placeholder="Cédula de Identidad" required>
                                            </div>
                                            <!-- Nombres del Estudiante -->
                                            <div class="container mt-2">
                                                <label for="names_input" class="form-label fs-5">Nombres</label>
                                                <input class="form-control" type="text" name="names_input"
                                                    placeholder="Nombres" required>
                                            </div>
                                            <!-- Apellidos del Estudiante -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="lastnames_input">Apellidos</label>
                                                <input class="form-control" type="text" name="lastnames_input"
                                                    placeholder="Apellidos" required>
                                            </div>
                                            <!-- Número de Teléfono -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="celNumber_input">Número
                                                    Celular</label>
                                                <input class="form-control" type="text" name="celNumber_input"
                                                    placeholder="Celular" required>
                                            </div>
                                            <!-- Correo Electrónico -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="email_input">Correo</label>
                                                <input class="form-control" type="email" name="email_input"
                                                    placeholder="Correo" required>
                                            </div>
                                            <!-- Dirección de Domicilio -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="addressCity_input">Domicilio</label>
                                                <input class="form-control" type="text" name="addressCity_input"
                                                    placeholder="Dirección Domiciliaria" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <!-- Barrio -->
                                            <div class="container mt-4">
                                                <label class="form-label fs-5" for="neighborhood_input">Barrio</label>
                                                <input class="form-control" type="text" name="neighborhood_input"
                                                    placeholder="Barrio" required>
                                            </div>
                                            <!-- Sector -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="quadrant_input">Sector</label>
                                                <input class="form-control" type="text" name="quadrant_input"
                                                    placeholder="Sector" required>
                                            </div>
                                            <div class="container mt-2">
                                                <!-- Semestre -->
                                                <div class="mt-2">
                                                    <label class="form-label fs-5" for="semester_input">Semestre</label>
                                                    <select class="form-select" name="semester_input" id="semester">
                                                        <option selected disabled>Elige tu Semestre</option>
                                                        <option value="Segundo">Segundo</option>
                                                        <option value="Tercero">Tercero</option>
                                                        <option value="Cuarto">Cuarto</option>
                                                        <option value="Quinto">Quinto</option>
                                                    </select>
                                                </div>
                                                <!-- Paralelo -->
                                                <div class="pt-2">
                                                    <label class="form-label fs-5" for="grade_input">Paralelo</label>
                                                    <select class="form-select" name="grade_input" id="grade">
                                                        <option selected disabled>Elige tu Semestre</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                    </select>
                                                </div>
                                                <!-- Jornada -->
                                                <div class="pt-2">
                                                    <label class="form-label fs-5" for="dayTrip_input">Jornada</label>
                                                    <select class="form-select" name="dayTrip_input" id="dayTrip">
                                                        <option selected disable>Elige tu Semestre</option>
                                                        <option value="Vespertina">Vespertina</option>
                                                        <option value="Nocturna">Nocturna</option>
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
                                <legend class="text-center">Sitio de Prácticas</legend>
                                <div class="container d-flex align-items-center ps-4 pe-4">
                                    <!-- Entidad -->
                                    <div class="container">
                                        <label class="form-label fs-5" for="entity_input">Institución</label>
                                        <select class="form-select" name="entity_input" id="entity">
                                            <option selected disabled>Selecciona la Institución</option>
                                            <?php if(!empty($instituciones)): ?>
                                                <?php foreach($instituciones as $institucion):?>
                                                    <option value="<?php echo $institucion['name'] . '|' . $institucion['direccion']; ?>">
                                                        <?php echo $institucion['entityInfo']; ?>
                                                    </option>>
                                                <?php endforeach;?>
                                            <?php else: ?>>
                                                <option selected disable>No hay Instituciones disponibles</option>
                                            <?php endif;?>>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    <button class="btn-primary ps-4 pe-4 p-2 rounded" type="submit">
                        <span class="fs-4 fw-bolder">Enviar</span>
                    </button>
                </div>
            </div>
        </form>
    </main>

    <footer class="container-fluid d-flex align-items-center justify-content-center">
        <span class="fs-5">Power By <a class="text-decoration-none" href="#">YggdrasilCode</a></span>
    </footer>
</body>

</html>