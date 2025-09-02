<?php

namespace App\Imports;

use App\Models\Career;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;

class TeachersImport implements ToModel, WithHeadingRow, WithEvents
{

    public $inserted = 0;
    public $duplicates = 0;

    protected $existingEmails = [];
    protected $seenEmails = [];

    public function __construct()
    {
        $this->existingEmails = User::pluck('email')->map(fn($e) => strtolower(trim($e)))->toArray();
    }

    protected $requiredHeaders = [
        'usuario',
        'correo',
        'nombres',
        'apellidos',
        'carrera',
    ];

    public function headingRow(): int
    {
        return 1;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {

                $this->seenEmails = [];

                $sheet = $event->reader->getActiveSheet();
                $highestColumn = $sheet->getHighestColumn();
                $headerRow = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, false)[0];

                $headings = array_map(fn($h) => strtolower(trim($h)), $headerRow);
                $required = array_map(fn($h) => strtolower(trim($h)), $this->requiredHeaders);

                $missing = array_diff($required, $headings);
                $extra = array_diff($headings, $required);

                if (!empty($missing) || !empty($extra)) {
                    $message = '';
                    if (!empty($missing)) {
                        $message .= 'Faltan columnas obligatorias: ' . implode(', ', $missing) . '. ';
                    }
                    if (!empty($extra)) {
                        $message .= 'Columnas no permitidas: ' . implode(', ', $extra) . '.';
                    }
                    throw new \Exception(trim($message));
                }
            },
        ];
    }

    /**
     * @param model $model
     */
    public function model(array $row)
    {
        $email = strtolower(trim($row['correo']));

        if (
            in_array($email, array_map('strtolower', $this->existingEmails)) ||
            in_array($email, $this->seenEmails)
        ) {
            $this->duplicates++;
            return null;
        }

        $this->seenEmails[] = $email;

        return DB::transaction(function () use ($row, $email) {
            $user = User::create([
                'name' => $row['usuario'],
                'email' => $email,
                'password' => Hash::make($row['usuario'] ?? 'SucreDoc' . now('Y')),
            ]);

            $user->assignRole('tutor');

            $career = Career::where('name', $row['carrera'])->first();

            TeacherProfile::create([
                'users_id' => $user->id,
                'name' => $row['nombres'],
                'lastnames' => $row['apellidos'],
                'career_id' => $career ? $career->id : null,
            ]);
            
            $this->inserted++;
            return $user;
        });
    }

    public function getInsertedCount()
    {
        return $this->inserted;
    }

    public function getDuplicatesCount()
    {
        return $this->duplicates;
    }
}
