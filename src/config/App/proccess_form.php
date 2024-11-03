<?php

session_start();
date_default_timezone_set('America/Guayaquil');

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file = '../../DataBase/db_practias_estudiantes.xlsx';
$fileEntity = '../../DataBase/db_istituciones.xlsx';

$entitySelected = $_POST['entity_input'];
$names_input = $_POST['names_input'];
$lastnames_input = $_POST['lastnames_input'];
$ci_input = $_POST['ci_input'];
$email_input = $_POST['email_input'];
$celNumber_input = $_POST['celNumber_input'];
$addressCity_input = $_POST['addressCity_input'];
$neighborhood_input = $_POST['neighborhood_input'];
$semester_input = $_POST['semester_input'];
$grade_input = $_POST['grade_input'];
$dayTrip_input = $_POST['dayTrip_input'];

list($nombreEntidad, $direccionEntidad) = explode('|', $entitySelected);

if (file_exists($file)) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Encabezados y Columnas
    $sheet->setCellValue('A1', 'Nombres y Apellidos Completos');
    $sheet->setCellValue('B1', 'Dirección de Correo Electrónico');
    $sheet->setCellValue('C1', 'Cédula de Identificación');
    $sheet->setCellValue('D1', 'Número Celular');
    $sheet->setCellValue('E1', 'Dirección de Domicilio');
    $sheet->setCellValue('F1', 'Barrio');
    $sheet->setCellValue('G1', 'Semestre Que Va a Cursar 2024 I');
    $sheet->setCellValue('H1', 'Paralelo (A, B, C, D)');
    $sheet->setCellValue('I1', 'Jornada (Vespertina, Nocturna)');
    $sheet->setCellValue('J1', 'Institución');
    $sheet->setCellValue('K1', 'Dirección');
    $sheet->setCellValue('L1', 'Tiempo de Registro');
}

$spreadsheetEntity = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileEntity);
$sheetEntity = $spreadsheetEntity->getActiveSheet();
// Verificar si la entidad ya fue Seleccionada
$lastRowInstituciones = $sheetEntity->getHighestRow();
$limitePlazas = null;
for ($row = 2; $row <= $lastRowInstituciones; $row++) { 
    
    $institucion = $sheetEntity->getCell("A$row")->getValue();
    $plazasDisponibles = $sheetEntity->getCell("B$row")->getValue();

    // Contar cuántas veces la entidad ha sido seleccionada

    if ($institucion === $nombreEntidad) {
        $limitePlazas = (int) $plazasDisponibles;
        break;
    }
}

$sheet = $spreadsheet->getActiveSheet();
$lastRow = $sheet->getHighestRow();
$count = 0;

for ($row = 2; $row <= $lastRow ; $row++) { 
    $entity = $sheet->getCell("J$row")->getValue();

    if ($entity === $nombreEntidad) {
        $count++;
    }
}

// Verificamos si la entidad ya ha alcanzado el límite de 5 personas
if ($count >= $limitePlazas) {

    // Guardar los datos del formulario en la sesión
    $_SESSION['old_data'] = $_POST;

    $_SESSION['flash_message'] = [
        'message' => 'Las plazasas para esta entidad ya fueron llenadas',
        'title' => 'Error',
        'type' => 'error'
    ];

    // Redirigir de nuevo al formulario con un mensaje de éxito en la URL
    header("Location: /");
    exit;
}

// Verificar si el estudiante ya está registrado
$alreadyRegistered = false;
for ($row = 2; $row <= $lastRow; $row++) { 
    $ciValue = $sheet->getCell("C$row")->getValue();
    if ($ciValue == $ci_input) {
        $alreadyRegistered = true;
        break;
    }
}

if ($alreadyRegistered) {
    // Guardar los datos del formulario en la sesión
    $_SESSION['old_data'] = $_POST;

    $_SESSION['flash_message'] = [
        'message' => 'Ya te has registrado',
        'title' => 'Usuario Registrado',
        'type' => 'error'
    ];

    // Redirigir de nuevo al formulario
    header("Location: /");
    exit;
}

// Añadir los datos del estudiante a una nueva fila

$full_name = $names_input . ' ' . $lastnames_input;
$newRow = $lastRow + 1;
$timestamp = date('Y-m-d H:i:s');

$sheet->setCellValue("A$newRow", $full_name);
$sheet->setCellValue("B$newRow", $email_input);
$sheet->setCellValue("C$newRow", $ci_input);
$sheet->setCellValue("D$newRow", $celNumber_input);
$sheet->setCellValue("E$newRow", $addressCity_input);
$sheet->setCellValue("F$newRow", $neighborhood_input);
$sheet->setCellValue("G$newRow", $semester_input);
$sheet->setCellValue("H$newRow", $grade_input);
$sheet->setCellValue("I$newRow", $dayTrip_input);
$sheet->setCellValue("J$newRow", $nombreEntidad);
$sheet->setCellValue("K$newRow", $direccionEntidad);
$sheet->setCellValue("L$newRow", $timestamp);

$writer = new Xlsx($spreadsheet);
$writer->save($file);

// Generamos el mensaje de success
$_SESSION['flash_message'] = [
    'message' => 'Datos guardados correctamente',
    'title' => 'Formulario Enviado',
    'type' => 'success'
];

// Luego rediriges a la página
header("Location: /");
exit;

?>