<?php

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
$quadrant_input = $_POST['quadrant_input'];
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
    $sheet->setCellValue('F1', 'Sector (Norte, Sur, Valle, etc)');
    $sheet->setCellValue('G1', 'Barrio');
    $sheet->setCellValue('H1', 'Semestre Que Va a Cursar 2024 I');
    $sheet->setCellValue('I1', 'Paralelo (A, B, C, D)');
    $sheet->setCellValue('J1', 'Jornada (Vespertina, Nocturna)');
    $sheet->setCellValue('K1', 'Institución');
    $sheet->setCellValue('L1', 'Dirección');
}


// Obtener la hoja Activa
$sheet = $spreadsheet->getActiveSheet();
// Verificar si la entidad ya fue Seleccionada
$lastRow = $sheet->getHighestRow();
$count = 0;
for ($row = 2; $row <= $lastRow; $row++) { 
    $entity = $sheet->getCell("I$row")->getValue();

    // Contar cuántas veces la entidad ha sido seleccionada

    if ($entity === $nombreEntidad) {
        // Contador de entidad
        $count++;
    }
}

// Verificamos si la entidad ya ha alcanzado el límite de 5 personas
if ($count >= 5) {
    // Redirigir de nuevo al formulario con un mensaje de éxito en la URL
    $mensaje = "La entidad ya ha sido sleccionada.";
    header("Location: /?mensaje=" . urlencode($mensaje));
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
$sheet->setCellValue("F$newRow", $quadrant_input);
$sheet->setCellValue("G$newRow", $neighborhood_input);
$sheet->setCellValue("H$newRow", $semester_input);
$sheet->setCellValue("I$newRow", $grade_input);
$sheet->setCellValue("J$newRow", $dayTrip_input);
$sheet->setCellValue("K$newRow", $nombreEntidad);
$sheet->setCellValue("L$newRow", $direccionEntidad);

$writer = new Xlsx($spreadsheet);
$writer->save($file);

// Redirigir de nuevo al formulario con un mensaje de éxito en la URL
$mensaje = "Datos guardados correctamente";
header("Location: /?mensaje=" . urlencode($mensaje));
exit;

?>