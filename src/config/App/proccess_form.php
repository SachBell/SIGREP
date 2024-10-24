<?php

session_start();

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file = '../../DataBase/db_practias_estudiantes.xlsx';

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
}


// Obtener la hoja Activa
$sheet = $spreadsheet->getActiveSheet();
// Verificar si la entidad ya fue Seleccionada
$lastRow = $sheet->getHighestRow();
$count = 0;
for ($row = 2; $row <= $lastRow; $row++) { 
    $entity = $sheet->getCell("J$row")->getValue();

    // Contar cuántas veces la entidad ha sido seleccionada

    if ($entity === $nombreEntidad) {
        // Contador de entidad
        $count++;
    }
}

// Verificamos si la entidad ya ha alcanzado el límite de 5 personas
if ($count >= 5) {

    // Guardar los datos del formulario en la sesión
    $_SESSION['old_data'] = $_POST;

    $_SESSION['flash_message'] = [
        'message' => 'Las plazasas para esta entidad ya fueron llenadas',
        'type' => 'error'
    ];

    // Redirigir de nuevo al formulario con un mensaje de éxito en la URL
    header("Location: /");
    exit;
}

// Añadir los datos del estudiante a una nueva fila

$full_name = $names_input . ' ' . $lastnames_input;
$newRow = $lastRow + 1;

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

$writer = new Xlsx($spreadsheet);
$writer->save($file);

// Generamos el mensaje de success
$_SESSION['flash_message'] = [
    'message' => 'Datos guardados correctamente',
    'type' => 'success'
];

// Luego rediriges a la página
header("Location: /");
exit;

?>