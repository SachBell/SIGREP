<?php
    
    session_start();

    $oldData = isset($_SESSION['old_data']) ? $_SESSION['old_data'] : null;
    unset($_SESSION['old_data']); // Limpiar la sesión después de usar los datos

    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;
    
    $fileEntity = 'src/DataBase/db_istituciones.xlsx';

    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $title = $_SESSION['flash_message']['title'];
        $type = $_SESSION['flash_message']['type'];
        unset($_SESSION['flash_message']); // Eliminar mensaje después de mostrarlo
    }

    // Cargar el archivo de Excel de instituciones y direcciones
    if (file_exists($fileEntity)) {
        $spreadsheetInstituciones = IOFactory::load($fileEntity);
    } else {
        die("No se encontro el archivo");
    }
    $sheetInstituciones = $spreadsheetInstituciones->getActiveSheet();
    $instituciones = [];
    $lastRowInstituciones = $sheetInstituciones->getHighestRow();

    for ($row=2; $row <= $lastRowInstituciones - 4; $row++) {

        $institucion = $sheetInstituciones->getCell("A$row")->getValue();
        $direccion = $sheetInstituciones->getCell("C$row")->getValue();
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/be6056a694.js" crossOrigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fs-2 fw-bold" href="/">ISUS SPP</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbaContetent" aria-controls="navbaContetent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbaContetent">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item fs-5">
                        <a class="nav-link active" href="/" aria-current="page">Inicio
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="/login">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid d-flex justify-content-center mt-5">
        <!-- Formulario de Estudiantes -->
        <form id="ppForm" class="pt-5 pb-5" action="src/config/App/proccess_form.php" method="POST">
            <?php if (isset($message)): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: '<?php echo $type; ?>', // 'success' o 'error'
                            title: '<?php echo $title; ?>',
                            text: '<?php echo $message; ?>',
                        });
                    });
                </script>
            <?php endif; ?>
            <div class="input-container container d-flex flex-column gap-5">
                <div class="container-fluid">
                    <div class="container-fluid d-flex justify-content-center">
                        <h2 class="fs-1 text-uppercase fw-bold text-center">Marco de Formación 2024 II CDII</h2>
                    </div>
                    <div class="container mt-4">
                        <p class="description fs-5">
                            ¡Bienvenido al sistema de gestión de prácticas! Este formulario ha sido diseñado para facilitar la coordinación entre los estudiantes y las instituciones que ofrecen oportunidades de prácticas preprofesionales.
                        </p>
                        <p class="description fs-5">
                            A través de este formulario, podrás registrar tus datos personales, seleccionar la institución que mejor se adapte a tu ubicación y postularte para las prácticas. <b>Ten en cuenta que cada institución cuenta con un límite de plazas disponibles.</b>
                        </p>
                        <span class="fs-5"><b>Los campos marcados con (<b style="color: red;">*</b>) son de carácter obligatorio.</b></span>
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
                                                <label class="form-label fs-5" for="ci_input"><b class="fw-bold" style="color: red;">*</b> Cédula</label>
                                                <input class="form-control" type="text" name="ci_input"
                                                    placeholder="Cédula de Identidad"
                                                    value="<?php echo $oldData['ci_input'] ?? ''; ?>" required>
                                            </div>
                                            <!-- Nombres del Estudiante -->
                                            <div class="container mt-2">
                                                <label for="names_input" class="form-label fs-5"><b class="fw-bold" style="color: red;">*</b> Nombres</label>
                                                <input class="form-control" type="text" name="names_input"
                                                    placeholder="Nombres"
                                                    value="<?php echo $oldData['names_input'] ?? ''; ?>" required>
                                            </div>
                                            <!-- Apellidos del Estudiante -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="lastnames_input"><b class="fw-bold" style="color: red;">*</b> Apellidos</label>
                                                <input class="form-control" type="text" name="lastnames_input"
                                                    placeholder="Apellidos"
                                                    value="<?php echo $oldData['lastnames_input'] ?? ''; ?>" required>
                                            </div>
                                            <!-- Número de Teléfono -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="celNumber_input"><b class="fw-bold" style="color: red;">*</b> Número
                                                    Celular</label>
                                                <input class="form-control" type="text" name="celNumber_input"
                                                    placeholder="Celular"
                                                    value="<?php echo $oldData['celNumber_input'] ?? ''; ?>" required>
                                            </div>
                                            <!-- Correo Electrónico -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="email_input"><b class="fw-bold" style="color: red;">*</b> Correo</label>
                                                <input class="form-control" type="email" name="email_input"
                                                    placeholder="Correo"
                                                    value="<?php echo $oldData['email_input'] ?? ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Dirección de Domicilio -->
                                            <div class="container mt-lg-4 mt-2">
                                                <label class="form-label fs-5" for="addressCity_input"><b class="fw-bold" style="color: red;">*</b> Domicilio</label>
                                                <input class="form-control" type="text" name="addressCity_input"
                                                    placeholder="Dirección Domiciliaria"
                                                    value="<?php echo $oldData['addressCity_input'] ?? ''; ?>" required>
                                            </div>
                                            <!-- Barrio -->
                                            <div class="container mt-2">
                                                <label class="form-label fs-5" for="neighborhood_input"><b class="fw-bold" style="color: red;">*</b> Barrio</label>
                                                <input class="form-control" type="text" name="neighborhood_input"
                                                    placeholder="Barrio"
                                                    value="<?php echo $oldData['neighborhood_input'] ?? ''; ?>"
                                                    required>
                                            </div>
                                            <div class="container mt-2">
                                                <!-- Semestre -->
                                                <div class="mt-2">
                                                    <label class="form-label fs-5" for="semester_input"><b class="fw-bold" style="color: red;">*</b> Semestre</label>
                                                    <select class="form-select" name="semester_input" id="semester"
                                                        required>
                                                        <option selected disabled>Elige tu Semestre</option>
                                                        <option value="Segundo" <?php echo ($oldData['semester_input']
                                                            ?? '' )==='Segundo' ? 'selected' : '' ; ?>>Segundo</option>
                                                        <option value="Tercero" <?php echo ($oldData['semester_input']
                                                            ?? '' )==='Tercero' ? 'selected' : '' ; ?>>Tercero</option>
                                                        <option value="Cuarto" <?php echo ($oldData['semester_input']
                                                            ?? '' )==='Cuarto' ? 'selected' : '' ; ?>>Cuarto</option>
                                                        <option value="Quinto" <?php echo ($oldData['semester_input']
                                                            ?? '' )==='Quinto' ? 'selected' : '' ; ?>>Quinto</option>
                                                    </select>
                                                </div>
                                                <!-- Paralelo -->
                                                <div class="pt-2">
                                                    <label class="form-label fs-5" for="grade_input"><b class="fw-bold" style="color: red;">*</b> Paralelo</label>
                                                    <select class="form-select" name="grade_input" id="grade" required>
                                                        <option selected disabled>Elige tu Semestre</option>
                                                        <option value="A" <?php echo ($oldData['grade_input'] ?? ''
                                                            )==='A' ? 'selected' : '' ; ?>>A</option>
                                                        <option value="B" <?php echo ($oldData['grade_input'] ?? ''
                                                            )==='B' ? 'selected' : '' ; ?>>B</option>
                                                        <option value="C" <?php echo ($oldData['grade_input'] ?? ''
                                                            )==='C' ? 'selected' : '' ; ?>>C</option>
                                                        <option value="D" <?php echo ($oldData['grade_input'] ?? ''
                                                            )==='D' ? 'selected' : '' ; ?>>D</option>
                                                    </select>
                                                </div>
                                                <!-- Jornada -->
                                                <div class="pt-2">
                                                    <label class="form-label fs-5" for="dayTrip_input"><b class="fw-bold" style="color: red;">*</b> Jornada</label>
                                                    <select class="form-select" name="dayTrip_input" id="dayTrip"
                                                        required>
                                                        <option selected disable>Elige tu Semestre</option>
                                                        <option value="Vespertina" <?php echo ($oldData['dayTrip_input']
                                                            ?? '' )==='Vespertina' ? 'selected' : '' ; ?>>Vespertina
                                                        </option>
                                                        <option value="Nocturna" <?php echo ($oldData['dayTrip_input']
                                                            ?? '' )==='Nocturna' ? 'selected' : '' ; ?>>Nocturna
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
                                        <label class="form-label fs-5" for="entity_input"><b class="fw-bold" style="color: red;">*</b> Institución</label>
                                        <select class="form-select" name="entity_input" id="entity" required>
                                            <option selected disabled>Selecciona la Institución</option>
                                            <?php if(!empty($instituciones)): ?>
                                            <?php foreach($instituciones as $institucion):?>
                                            <option
                                                value="<?php echo htmlspecialchars($institucion['name'] . '|' . $institucion['direccion']); ?>">
                                                <?php echo htmlspecialchars($institucion['entityInfo']); ?>
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
                <div class="container d-flex justify-content-center mt-4">
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