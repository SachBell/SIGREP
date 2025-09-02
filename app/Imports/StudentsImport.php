<?php

namespace App\Imports;

use App\Models\Career;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\User;
use App\Models\UserData;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;

class StudentsImport implements ToModel, WithHeadingRow, WithEvents
{

    public $inserted = 0;
    public $duplicates = 0;

    protected $existingEmails = [];
    protected $existingIds = [];
    protected $seenEmails = [];
    protected $seenIds = [];

    public function __construct()
    {
        $this->existingEmails = User::pluck('email')->map(fn($e) => strtolower(trim($e)))->toArray();
        $this->existingIds = UserProfile::pluck('id_card')->map(fn($c) => trim($c))->toArray();
    }

    protected $requiredHeaders = [
        'usuario',
        'correo',
        'nombres',
        'apellidos',
        'cedula',
        'celular',
        'direccion_de_domicilio',
        'barrio',
        'carrera',
        'semestre',
        'paralelo',
        'jornada'
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
                $this->seenIds = [];

                $sheet = $event->reader->getActiveSheet();
                $highestColumn = $sheet->getHighestColumn();
                $headerRow = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, false)[0];

                $headings = array_map(fn($h) => Str::slug($h, '_'), $headerRow);
                $required = array_map(fn($h) => Str::slug($h, '_'), $this->requiredHeaders);

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
        $idCard = trim($row['cedula']);

        if (
            in_array($email, array_map('strtolower', $this->existingEmails)) ||
            in_array($idCard, array_map('trim', $this->existingIds)) ||
            in_array($email, $this->seenEmails) ||
            in_array($idCard, $this->seenIds)
        ) {
            $this->duplicates++;
            return null;
        }

        $this->seenEmails[] = $email;
        $this->seenIds[] = $idCard;

        return DB::transaction(function () use ($row, $email, $idCard) {
            $user = User::create([
                'name' => $row['usuario'],
                'email' => $email,
                'password' => Hash::make($row['usuario'] ?? 'Sucre' . now('Y')),
            ]);

            $user->assignRole('student');

            $profile = UserProfile::create([
                'users_id' => $user->id,
                'name' => $row['nombres'],
                'lastnames' => $row['apellidos'],
                'phone_number' => $row['celular'],
                'id_card' => $idCard,
                'address' => $row['direccion_de_domicilio'],
                'neighborhood' => $row['barrio'],
            ]);

            $career = Career::where('name', $row['carrera'])->first();
            $semester = Semester::where('semester', $row['semestre'])->first();
            $grade = Grade::where('grade', $row['paralelo'])->first();

            UserData::create([
                'profile_id' => $profile->id,
                'career_id' => $career ? $career->id : null,
                'semester_id' => $semester ? $semester->id : null,
                'grade_id' => $grade ? $grade->id : null,
                'daytrip' => $row['jornada'],
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
