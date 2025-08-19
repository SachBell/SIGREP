<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{

    protected $data;
    protected $reportType;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($data, $reportType)
    {
        $this->data = $data;
        $this->reportType = $reportType;
    }

    public function collection()
    {
        // Dependiendo del tipo de reporte preparar coleccion
        switch ($this->reportType) {
            case 'general':
                return $this->formatGeneral();
            case 'teacher':
                return $this->formatDocente();
            case 'student':
                return $this->formatEstudiante();
            default:
                return collect();
        }
    }

    protected function formatGeneral()
    {
        // Ajusta según estructura de $this->data
        return $this->data->map(function ($item) {
            $fullnameStudent = $item->userData->profiles->name . ' ' . $item->userData->profiles->lastnames;
            $fullnameTeacher = $item->tutorStudent && $item->tutorStudent->profiles
                ? $item->tutorStudent->profiles->name . ' ' . $item->tutorStudent->profiles->lastnames
                : 'No hay docente asignado';

            $isDual = $item->userData->careers->is_dual;
            $requiredVisits = $isDual ? 2 : 1;

            $base = [
                'Nombre' => $fullnameStudent,
                'Cédula' => $item->userData->profiles->id_card,
                'Carrera' => $item->userData->careers->name,
                'Modalidad' => $item->userData->careers->is_dual ? 'Dual' : 'Convencional',
                'Entidad' => $item->receivingEntities->name,
                'Periodo' => $item->applicationCalls->name,
                'Estado' => $item->status_individual,
                'Tutor' => $fullnameTeacher,
                'Cumple Horas' => $item->has_completed_hours ? 'Sí' : 'No',
            ];

            $visits = $item->tutorStudent->visits ?? collect();

            for ($i = 1; $i <= $requiredVisits; $i++) {
                $visit = $visits->firstWhere('visit_number', $i);
                $base["Observación Visita {$i}"] = $visit?->observation ?? 'Sin observación';
            }

            return $base;
        });
    }

    protected function formatDocente()
    {
        // $this->data es un objeto TeacherProfile que tiene la relación con tutor_students
        $rows = collect();
        $item = $this->data;

        foreach ($item->tutor as $tutorStudent) {
            $studentProfile = $tutorStudent->userData;
            $userData = $studentProfile->userData;
            $visits = $tutorStudent->visits;

            foreach ($visits as $visit) {
                $rows->push([
                    'Tutor' => $item->name . ' ' . $item->lastnames,
                    'Estudiante' => $studentProfile->full_name ?? ($studentProfile->name . ' ' . $studentProfile->lastnames),
                    'Entidad' => $userData->receivingEntity->name ?? '',
                    'Modalidad' => $userData->careers->is_dual ? 'Dual' : 'Convencional',
                    'Periodo' => $userData->applicationDetail->applicationCalls->name ?? '',
                    'Fecha Visita' => $visit->date,
                    'Observación' => $visit->observation ?? 'Sin observación',
                    'Estado Visita' => $visit->is_completed ? 'Completada' : 'Pendiente',
                ]);
            }
        }

        return $rows;
    }


    protected function formatEstudiante()
    {
        $student = $this->data;
        $rows = collect();

        $profile = $student->profiles;

        foreach ($profile->tutorStudents as $tutorStudent) {
            foreach ($tutorStudent->visits as $visit) {
                $rows->push([
                    'Estudiante' => $profile->name . ' ' . $profile->lastnames,
                    'Cédula' => $profile->id_card,
                    'Carrera' => $profile->userData->careers->name,
                    'Modalidad' => $profile->userData->careers->is_dual ? 'Dual' : 'Convencional',
                    'Entidad' => $profile->userData->applicationDetail->receivingEntities->name ?? 'N/A',
                    'Fecha Visita' => $visit->date ?? 'N/A',
                    'Observación' => $visit->observation ?? 'N/A',
                    'Tutor Visitante' => $tutorStudent->profiles->name . ' ' . $tutorStudent->profiles->lastnames ?? 'N/A',
                    'Estado' => $visit->is_complete ? 'Completada' : 'Pendiente',
                ]);
            }
        }


        return $rows;
    }
}
