<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Semester;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws Exception
     */
    public function model(array $row)
    {
        // dd($row);
        $formattedRow = $this->formatArrayKeys($row);

        // Verificar si ya existe un usuario con el mismo correo, nombre de usuario, cédula o teléfono
        $userExists = User::where('email', trim(strtolower($formattedRow['Correo'])))
            ->orWhere('name', trim(strtolower($formattedRow['Usuario'])))
            ->orWhereHas('userData', function ($query) use ($formattedRow) {
                $query->where('id_card', trim($formattedRow['Cedula']))
                    ->orWhere('phone_number', trim($formattedRow['Telefono']));
            })
            ->exists();

        // Si el usuario ya existe, lanzamos una excepción
        if ($userExists) {
            throw new Exception('El usuario con el correo, nombre de usuario, cédula o teléfono ya existe.');
        }

        $user = User::where('email', $formattedRow['Correo'])->first();

        $defaultPassword = Hash::make('Sucre' . now()->format('Y'));

        $user = User::create([
            'name' => $formattedRow['Usuario'],
            'email' => $formattedRow['Correo'],
            'password' => $defaultPassword
        ]);

        $user->assignRole('user');

        UserData::create([
            'id_user' => $user->id,
            'id_card' => $formattedRow['Cedula'],
            'name' => $formattedRow['Nombres'],
            'lastname' => $formattedRow['Apellidos'],
            'phone_number' => $formattedRow['Telefono'],
            'address' => $formattedRow['Direccion'],
            'neighborhood' => $formattedRow['Barrio'],
            'id_semester' => Semester::where('semester', $formattedRow['Semestre'])->value('id'),
            'id_grade' => Grade::where('grade', $formattedRow['Paralelo'])->value('id'),
            'daytrip' => $formattedRow['Jornada'],
        ]);

        return $user;
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
