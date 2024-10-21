<?php
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
    <link rel="stylesheet" href="/public/css/app.css">
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
        <form action="/src/config/App/proccess_form.php" method="POST">
            <div class="input-container container d-flex flex-column gap-4">
                <div class="container-fluid d-flex justify-content-center">
                    <h1>Selección de Prácticas Pre-Profecionales</h1>
                </div>
                <div class="container">
                    <p id="mensaje" style="display: <?= $mensaje === '' ? 'none' : 'block' ?>;">
                        <?= htmlspecialchars($mensaje) ?>
                    </p>
                    <script>
                        window.onload = function() {
                            const mensajeElement = document.getElementById('mensaje');
                            if (mensajeElement.style.display === 'block') {
                                setTimeout(function() {
                                    window.location.href = '/';
                                    mensajeElement.style.display = 'none';
                                }, 5000);
                            }
                        };
                    </script>
                </div>
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-6">
                            <!-- Nombres del Estudiante -->
                            <legend class="container">
                                <label for="names_input" class="form-label">Nombres</label>
                                <input class="form-control" type="text" name="names_input" placeholder="Nombres"
                                    required>
                            </legend>
                            <!-- Apellidos -->
                            <legend class="container">
                                <label class="form-label" for="lastnames_input">Apellidos</label>
                                <input class="form-control" type="text" name="lastnames_input" placeholder="Apellidos"
                                    required>
                            </legend>
                            <!-- C.I -->
                            <legend class="container">
                                <label class="form-label" for="ci_input">Cédula</label>
                                <input class="form-control" type="text" name="ci_input"
                                    placeholder="Cédula de Identidad" required>
                            </legend>
                            <!-- Correo Electrónico -->
                            <legend class="container">
                                <label class="form-label" for="email_input">Correo</label>
                                <input class="form-control" type="email" name="email_input" placeholder="Correo"
                                    required>
                            </legend>
                            <!-- Número de Teléfono -->
                            <legend class="container">
                                <label class="form-label" for="celNumber_input">Número Celular</label>
                                <input class="form-control" type="text" name="celNumber_input" placeholder="Celular"
                                    required>
                            </legend>
                        </div>
                        <div class="col-6">
                            <!-- Entidad -->
                            <legend class="container">
                                <label for="entity_input">Entidad</label>
                                <select class="form-select" name="entity_input" id="entity">
                                    <option selected disabled>Selecciona una Entidad</option>
                                    <option value="Entidad 1">Entidad 1</option>
                                    <option value="Entidad 2">Entidad 2</option>
                                    <option value="Entidad 3">Entidad 3</option>
                                    <option value="Entidad 4">Entidad 4</option>
                                </select>
                            </legend>
                            <!-- Dirección de Domicilio -->
                            <legend class="container">
                                <label class="form-label" for="addressCity_input">Dirección</label>
                                <input class="form-control" type="text" name="addressCity_input"
                                    placeholder="Dirección Domiciliaria" required>
                            </legend>
                            <!-- Sector -->
                            <legend class="container">
                                <label class="form-label" for="quadrant_input">Sector</label>
                                <input class="form-control" type="text" name="quadrant_input" placeholder="Sector"
                                    required>
                            </legend>
                            <!-- Barrio -->
                            <legend class="container">
                                <label class="form-label" for="neighborhood_input">Barrio</label>
                                <input class="form-control" type="text" name="neighborhood_input" placeholder="Barrio"
                                    required>
                            </legend>
                            <!-- Semestre -->
                            <legend class="container">
                                <label class="form-label" for="semester_input">Semestre</label>
                                <input class="form-control" type="text" name="semester_input" placeholder="Semestre"
                                    required>
                            </legend>
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
        <span class="fs-5">Power By <a class="text-decoration-none" href="https://alfahost.es">AlfaHost</a></span>
    </footer>
</body>

</html>