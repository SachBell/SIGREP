<?php
require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

try {
    $entitySelected = $_POST['institucion'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $cei = $_POST['cei'] ?? '';
    $address = $_POST['address'] ?? '';
    $celphone = $_POST['celphone'] ?? '';
    $cuadrant = $_POST['cuadrant'] ?? '';
    $row = isset($_POST['row']) ? intval($_POST['row']) : null;
    $data_file = '../../../DataBase/db_practias_estudiantes.xlsx';

    $actualRow = $row + 1;

    list($nombreEntidad, $direccionEntidad) = explode('|', $entitySelected);

    if (!$actualRow) {
        throw new Exception("El índice de fila no es válido.");
    }

    if (!file_exists($data_file)) {
        throw new Exception("Archivo no encontrado.");
    }

    $spreadsheet = IOFactory::load($data_file);
    $sheet = $spreadsheet->getActiveSheet();

    // Actualiza los datos en el archivo Excel
    $sheet->setCellValue("A" . ($actualRow + 1), $name); // El +1 es porque las filas de Excel empiezan en 1
    $sheet->setCellValue("B" . ($actualRow + 1), $cei); // El +1 es porque las filas de Excel empiezan en 1
    $sheet->setCellValue("C" . ($actualRow + 1), $email); // El +1 es porque las filas de Excel empiezan en 1
    $sheet->setCellValue("D" . ($actualRow + 1), $celphone); // El +1 es porque las filas de Excel empiezan en 1
    $sheet->setCellValue("E" . ($actualRow + 1), $address); // El +1 es porque las filas de Excel empiezan en 1
    $sheet->setCellValue("F" . ($actualRow + 1), $cuadrant); // El +1 es porque las filas de Excel empiezan en 1

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($data_file);

    echo "success";
} catch (Exception $e) {
    echo "error:" . $e->getMessage();
}

?>