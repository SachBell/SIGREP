<?php

namespace App\Imports;

use App\Models\Institute;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class InstitutesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws Exception
     */
    public function model(array $row)
    {
        $formateddRow = $this->formatArrayKeys($row);

        $instituteExist = Institute::where('name', trim(strtolower($formateddRow['Institucion'])))->exists();

        if ($instituteExist) {
            throw new Exception('El instituto que deseas ingresar ya existe.');
        }

        $institute = Institute::create([
            'name' => $formateddRow['Institucion'],
            'user_limit' => $formateddRow['Cupos'],
            'address' => $formateddRow['Direccion']
        ]);

        return $institute;
    }

    /**
     * Función para convertir las claves de un array a capitalizadas.
     */
    private function formatArrayKeys(array $array)
    {
        $formattedArray = [];

        foreach ($array as $key => $value) {
            // Reemplazar espacios con guiones bajos y capitalizar la primera letra de cada palabra
            $newKey = str_replace(' ', '_', $key); // Reemplazar los espacios con guiones bajos
            $newKey = ucwords(strtolower($newKey)); // Capitalizar la primera letra de cada palabra

            $formattedArray[$newKey] = $value;
        }

        return $formattedArray;
    }
}
