<?php

namespace App\Imports;

use App\Models\Career;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\User;
<<<<<<< HEAD
=======
use App\Models\UserData;
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
<<<<<<< HEAD
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;

/**
 * StudentsImport
 *
 * High-performance Excel import for student users.
 * - Handles duplicate detection in PHP (emails + ID cards)
 * - Uses buffered bulk inserts to drastically reduce execution time
 * - Keeps data consistency using a single DB transaction
 * - Resolves foreign keys (career, semester, grade) using cached catalogs
 */
class StudentsImport implements ToModel, WithHeadingRow, WithEvents
{
    /** Counters for reporting */
    public $inserted = 0;
    public $duplicates = 0;

    /** Existing records from DB (used for duplicate detection) */
    protected $existingEmails = [];
    protected $existingIds = [];

    /** Records already processed during the current import */
    protected $seenEmails = [];
    protected $seenIds = [];

    /** Cached catalogs to avoid DB queries per row */
    protected $careers;
    protected $semesters;
    protected $grades;

    /** Default password for imported users */
    protected string $defaultPassword;

    /** Buffers for batch inserts */
    protected array $usersBuffer = [];
    protected array $rowsBuffer = [];

    /** Number of rows inserted per batch */
    protected int $bufferSize = 1000;

    /** Shared timestamp to keep consistency */
    protected $now;

    public function __construct()
    {
        // Default password pattern for imported students
        $this->defaultPassword = Hash::make('Sucre' . date('Y'));

        // Single timestamp reused across inserts
        $this->now = now();
    }

    /**
     * Required Excel headers.
     * Any missing or extra column will abort the import.
     */
    protected $requiredHeaders = [
        'usuario',
        'correo',
        'apellidos',
        'nombres',
=======
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
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
        'cedula',
        'celular',
        'direccion_de_domicilio',
        'barrio',
        'carrera',
        'semestre',
        'paralelo',
        'jornada'
    ];

<<<<<<< HEAD
    /**
     * Excel heading row index
     */
=======
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
    public function headingRow(): int
    {
        return 1;
    }

<<<<<<< HEAD
    /**
     * Register import lifecycle events
     */
    public function registerEvents(): array
    {
        return [

            /**
             * BEFORE IMPORT
             *
             * - Load existing users and profiles for duplicate detection
             * - Cache catalog tables (career, semester, grade)
             * - Validate Excel headers
             * - Start DB transaction
             */
            BeforeImport::class => function (BeforeImport $event) {

                // Reset in-memory duplicate trackers
                $this->seenEmails = [];
                $this->seenIds = [];

                // Load existing users (email-based)
                $this->existingEmails = User::pluck('email')
                    ->map(fn($e) => strtolower(trim($e)))
                    ->flip()
                    ->toArray();

                // Load existing profiles (ID card-based)
                $this->existingIds = UserProfile::pluck('id_card')
                    ->map(fn($c) => trim($c))
                    ->flip()
                    ->toArray();

                // Cache catalogs using slug keys for safe matching
                $this->careers = Career::all()
                    ->mapWithKeys(fn($c) => [Str::slug($c->name) => $c->id]);

                $this->semesters = Semester::all()
                    ->mapWithKeys(fn($s) => [Str::slug($s->semester) => $s->id]);

                $this->grades = Grade::all()
                    ->mapWithKeys(fn($g) => [Str::slug($g->grade) => $g->id]);

                // Validate Excel headers strictly
                $reader = $event->getReader();
                $sheet = $reader->getActiveSheet();
=======
    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {

                $this->seenEmails = [];
                $this->seenIds = [];

                $sheet = $event->reader->getActiveSheet();
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                $highestColumn = $sheet->getHighestColumn();
                $headerRow = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, false)[0];

                $headings = array_map(fn($h) => Str::slug($h, '_'), $headerRow);
                $required = array_map(fn($h) => Str::slug($h, '_'), $this->requiredHeaders);

                $missing = array_diff($required, $headings);
<<<<<<< HEAD
                $extra   = array_diff($headings, $required);

                if ($missing || $extra) {
                    throw new \Exception(
                        ($missing ? 'Missing columns: ' . implode(', ', $missing) . '. ' : '') .
                            ($extra ? 'Extra columns not allowed: ' . implode(', ', $extra) . '.' : '')
                    );
                }

                // Start transaction (committed in AfterImport)
                DB::beginTransaction();
            },

            /**
             * AFTER IMPORT
             *
             * - Flush remaining buffered data
             * - Commit DB transaction
             */
            AfterImport::class => function (AfterImport $event) {
                $this->flushUsers();
                DB::commit();
            }
=======
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
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
        ];
    }

    /**
<<<<<<< HEAD
     * Process a single Excel row.
     *
     * IMPORTANT:
     * This method does NOT hit the database directly.
     * It only prepares buffered data for batch insertion.
     */
    public function model(array $row)
    {
        $email  = strtolower(trim($row['correo']));
        $idCard = trim($row['cedula']);

        // Duplicate detection (DB + current import)
        if (
            isset($this->existingEmails[$email]) ||
            isset($this->existingIds[$idCard]) ||
            isset($this->seenEmails[$email]) ||
            isset($this->seenIds[$idCard])
        ) {
            $this->duplicates++;
            return;
        }

        // Mark as seen in current import
        $this->seenEmails[$email] = true;
        $this->seenIds[$idCard]   = true;

        // Buffer user insert
        $this->usersBuffer[] = [
            'name'       => $row['usuario'],
            'email'      => $email,
            'password'   => $this->defaultPassword,
            'created_at' => $this->now,
            'updated_at' => $this->now,
        ];

        // Keep original row for relational inserts
        $this->rowsBuffer[] = $row;

        $this->inserted++;

        // Flush buffer when limit is reached
        if (count($this->usersBuffer) >= $this->bufferSize) {
            $this->flushUsers();
        }
    }

    /** Public stats helpers */
=======
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

>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
    public function getInsertedCount()
    {
        return $this->inserted;
    }
<<<<<<< HEAD
=======

>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
    public function getDuplicatesCount()
    {
        return $this->duplicates;
    }
<<<<<<< HEAD

    /**
     * Flush buffered data to database in bulk.
     *
     * Steps:
     * 1. Insert users
     * 2. Resolve user IDs by email
     * 3. Insert roles and profiles
     * 4. Resolve profile IDs
     * 5. Insert user_data records
     * 6. Clear buffers
     */
    protected function flushUsers(): void
    {
        if (empty($this->usersBuffer)) {
            return;
        }

        // Bulk insert users
        DB::table('users')->insert($this->usersBuffer);

        // Retrieve inserted user IDs by email
        $emails = array_column($this->usersBuffer, 'email');

        $users = DB::table('users')
            ->whereIn('email', $emails)
            ->pluck('id', 'email');

        $roles    = [];
        $profiles = [];
        $userData = [];

        // Prepare roles and profiles
        foreach ($this->rowsBuffer as $row) {
            $userId = $users[$row['correo']] ?? null;
            if (!$userId) continue;

            $roles[] = [
                'role_id'   => 5,
                'model_type' => User::class,
                'model_id'  => $userId,
            ];

            $profiles[] = [
                'users_id'    => $userId,
                'name'        => $row['nombres'],
                'lastnames'   => $row['apellidos'],
                'phone_number' => $row['celular'],
                'id_card'     => $row['cedula'],
                'address'     => $row['direccion_de_domicilio'],
                'neighborhood' => $row['barrio'] ?? 'S/N',
                'created_at'  => $this->now,
                'updated_at'  => $this->now,
            ];
        }

        DB::table('model_has_roles')->insert($roles);
        DB::table('user_profiles')->insert($profiles);

        // Map profiles by user ID
        $profilesMap = DB::table('user_profiles')
            ->whereIn('users_id', $users->values())
            ->pluck('id', 'users_id');

        // Prepare user_data records
        foreach ($this->rowsBuffer as $row) {
            $userId    = $users[$row['correo']] ?? null;
            $profileId = $profilesMap[$userId] ?? null;
            if (!$profileId) continue;

            $userData[] = [
                'profile_id'  => $profileId,
                'career_id'   => $this->careers[Str::slug(trim($row['carrera']))] ?? null,
                'semester_id' => $this->semesters[Str::slug(trim($row['semestre']))] ?? null,
                'grade_id'    => $this->grades[Str::slug(trim($row['paralelo']))] ?? null,
                'daytrip'     => $row['jornada'],
                'created_at'  => $this->now,
                'updated_at'  => $this->now,
            ];
        }

        DB::table('user_data')->insert($userData);

        // Clear buffers
        $this->usersBuffer = [];
        $this->rowsBuffer  = [];
    }
=======
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
}
