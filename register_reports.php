<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$data_file = 'src/DataBase/db_practias_estudiantes.xlsx';
$fileEntity = 'src/DataBase/db_istituciones.xlsx';
$instituciones = [];

$spreadsheetInstituciones = IOFactory::load($data_file);

if (file_exists($data_file)) {
    $spreadsheet = IOFactory::load($data_file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
} else {
    die('Archivo no encontrado.');
}

if (file_exists($fileEntity)) {
    $spreadsheetInstituciones = IOFactory::load($fileEntity);
    $sheetInstituciones = $spreadsheetInstituciones->getActiveSheet();
    $lastRowInstituciones = $sheetInstituciones->getHighestRow();

    for ($row = 2; $row <= $lastRowInstituciones; $row++) {
        $institucion = $sheetInstituciones->getCell("A$row")->getValue();
        $direccion = $sheetInstituciones->getCell("C$row")->getValue();
        if (!empty($institucion) && !empty($direccion)) {
            $instituciones[] = [
                'name' => $institucion,
                'direccion' => $direccion,
                'entityInfo' => $institucion . ' - ' . $direccion
            ];
        }
    }
} else {
    die("No se encontró el archivo");
}

// Pasar las instituciones a JavaScript como JSON
$institucionesJson = json_encode($instituciones);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <a class="nav-link" href="/dashboard">Inicio</a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link active" href="/register_reports" aria-current="page">Registros
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="" onclick="logout()">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>        

    <main class="mt-5 mb-5">
        <div class="table-container container-fluid rounded table-responsive bg-light">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <?php
                            for ($col = 'A'; $col <= $highestColumn ; $col++) { 
                                echo "<th class='fs-6 text-center col-4 align-middle'>" . $sheet->getCell($col . '1')->getValue() . "</th>";
                            }
                        ?>
                        <th class="fs-6 text-center col-4 align-middle">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($row = 2; $row <= $highestRow ; $row++) { 
                            echo '<tr>';
                            for ($col = 'A'; $col <= $highestColumn ; $col++) { 
                                $value = $sheet->getCell($col . $row)->getValue();
                                echo '<td class="align-middle">' . $value . '</td>';
                            }
                            ?>

                            <td class="align-middle col-4">
                                <button class="btn-primary btn-sm" onclick="openEditForm(<?php echo $row; ?>)" data-row="<?php echo $row; ?>">Editar</button>
                                <button class="btn-danger btn-sm">Eliminar</button>
                            </td>

                            <?php
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container-fluid mt-5 bg-light">
            <p class="fs-5">Para descargar los resultados del formulario da <a id="downloadLink" href="" download>click aquí</a></p>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const downloadLink = document.getElementById('downloadLink');
        downloadLink.href = 'http://practicasisus.test/src/DataBase/db_practias_estudiantes.xlsx';
        
        const instituciones = <?php echo $institucionesJson; ?>;
        
        // Función para abrir el formulario de edición
        window.openEditForm = function(row) {
            const table = document.querySelector('table');
            const actualRow = row - 1; // Asegúrate de seleccionar la tabla correcta
            const rowElement = table.rows[actualRow]; // Obtiene la fila correspondiente
            const cells = rowElement.cells; // Obtiene todas las celdas de esa fila
            const name = cells[0].innerText; // Ajusta el índice según la columna
            const email = cells[1].innerText; // Ajusta el índice según la columna
            const cei = cells[2].innerText; // Ajusta el índice según la columna
            const celphone = cells[3].innerText; // Ajusta el índice según la columna
            const address = cells[4].innerText; // Ajusta el índice según la columna
            const cuadrant = cells[5].innerText;
            console.log(actualRow);
            
            // Construir el HTML del formulario
            let institutionOptions = '<option selected disabled>Selecciona la Institución</option>';
            instituciones.forEach(institucion => {
                institutionOptions += `<option value="${institucion.name}|${institucion.direccion}">${institucion.entityInfo}</option>`;
            });

            Swal.fire({
                title: 'Actualizar Datos',
                width: '800px',
                html: `
                    <input type="hidden" id="rowIndex" value="${actualRow}">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${cei}">Cédula de Identidad</label>
                                    <input id="cei" class="form-control" placeholder="Cédula" value="${cei}">
                                </div>
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${name}">Nombres y Apellidos</label>
                                    <input id="name" class="form-control" placeholder="Nombres y Apellidos" value="${name}">
                                </div>
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${email}">Correo Electrónico</label>
                                    <input id="email" class="form-control" placeholder="Correo Electrónico" value="${email}">
                                </div>
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${celphone}">Número de Celular</label>
                                    <input id="celphone" class="form-control" placeholder="Número de Celular" value="${celphone}">
                                </div>
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${address}">Dirección de Domicilio</label>
                                    <input id="address" class="form-control" placeholder="Dirección de Domicilio" value="${address}">
                                </div>
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="${cuadrant}">Dirección de Domicilio</label>
                                    <input id="cuadrant" class="form-control" placeholder="Dirección de Domicilio" value="${cuadrant}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container d-flex flex-column mt-4">
                                    <label class="form-label fs-5 text-start" for="entity_input">Institución</label>
                                    <select class="form-select" name="entity_input" id="entity_input" required>
                                        ${institutionOptions}
                                    </select>
                                </div>
                            </div>                  
                        </div>
                    </div>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('name').value,
                        document.getElementById('email').value,
                        document.getElementById('cei').value,
                        document.getElementById('celphone').value,
                        document.getElementById('address').value,
                        document.getElementById('cuadrant').value,
                        document.getElementById('rowIndex').value,
                        document.getElementById('entity_input').value
                    ];
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const [name, cei, email, address, celphone, cuadrant, institucion, rowIndex] = result.value;
                    const params = new URLSearchParams({
                        name: name,
                        cei: cei,
                        email: email,
                        address: address,
                        celphone: celphone,
                        cuadrant: cuadrant,
                        institution: institucion,
                        row: rowIndex
                    });

                    fetch('http://practicasisus.test/src/config/App/Controller/update_data.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: params
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.includes("success")) {
                            Swal.fire('Actualizado', 'Los datos del estudiante han sido actualizados', 'success').then(() => { 
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'No se pudo actualizar el registro', 'error');
                            console.log(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        };
    });
</script>
    </main>
</body>
</html>