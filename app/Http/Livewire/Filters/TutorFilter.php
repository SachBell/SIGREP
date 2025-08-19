<?php

namespace App\Http\Livewire\Filters;

use App\Helpers\SettingsHelper;
use App\Models\TeacherProfile;
use App\Models\TutorStudent;
use App\Models\TutorVisits;
use Livewire\Component;

class TutorFilter extends Component
{
    public $search = '';

    protected $listeners = ['refreshTutorFilter' => '$refresh'];

    public function render()
    {
        $authUser = auth()->user();

        $dualVisitCount = (int) SettingsHelper::get('dual_visit_count', 2);
        $convVisitCount = (int) SettingsHelper::get('conv_visits_count', 1);

        // Consulta base modificada para la nueva estructura
        $query = TeacherProfile::with([
            'career',
            'students.userData.careers',
            'students.userData.semesters',
            'students.userData.grades',
        ]);

        // Filtro por rol
        if ($authUser->hasRole('admin')) {
            // Admin ve todo
        } elseif ($authUser->hasRole('gestor-teacher')) {
            $query->where('career_id', $authUser->getCareerIdForScope());
        } elseif ($authUser->hasRole('tutor')) {
            $query->where('users_id', $authUser->id);
        } else {
            $query->whereRaw('1=0');
        }

        // Filtro por búsqueda
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('students', function ($q) {
                        $q->whereHas('userData', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('lastnames', 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        // Obtener resultados y procesar
        $studentTutor = $query->get()->map(function ($teacher) use ($authUser, $convVisitCount, $dualVisitCount) {
            $studentsData = $teacher->students->map(function ($student) use ($teacher, $convVisitCount, $dualVisitCount) {
                $relation = TutorStudent::where('teacher_profile_id', $teacher->id)
                    ->where('user_profile_id', $student->id)
                    ->first();

                $tutorStudentId = optional($relation)->id;

                $visits = TutorVisits::where('tutor_students_id', $tutorStudentId)
                    ->orderBy('created_at', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();

                $firstVisit = $visits->get(0);
                $secondVisit = $visits->get(1);

                $visitToShow = null;

                $secondVisitCompleted = $secondVisit ? (bool)$secondVisit->is_complete : false;

                $isDual = $student->userData->careers->is_dual ?? false;
                $requiredVisits = $isDual ? $dualVisitCount : $convVisitCount;
                $visitsMade = $visits->count();

                if ($visitsMade >= $requiredVisits) {
                    // Revisar si la última visita está completada
                    $lastVisit = $visits->last();
                    if ($lastVisit && !(bool) $lastVisit->is_complete) {
                        // Última visita incompleta => permitir editarla
                        $visitButtonText = 'Editar visita ' . $visitsMade;
                        $visitAction = 'edit';
                        $visitId = $lastVisit->id;
                    } else {
                        // Todas las visitas completadas => no mostrar botón
                        $visitButtonText = 'Visitas completas';
                        $visitAction = 'none';
                        $visitId = $lastVisit ? $lastVisit->id : null;
                    }
                } else {
                    // Si no has completado las visitas necesarias
                    $lastVisit = $visits->last();

                    if ($lastVisit && !$lastVisit->is_complete) {
                        // Todavía hay una visita pendiente de completar
                        $visitButtonText = 'Editar visita ' . $visitsMade;
                        $visitAction = 'edit';
                        $visitId = $lastVisit->id;
                    } else {
                        // La última está completa, se puede crear la siguiente
                        $visitButtonText = 'Agendar visita ' . ($visitsMade + 1);
                        $visitAction = 'create';
                        $visitId = null;
                    }
                }

                if (isset($visitId) && $visitId !== null) {
                    $visitToShow = $visits->firstWhere('id', $visitId);
                } else {
                    $visitToShow = $firstVisit;
                }

                return [
                    'id' => $student->id,
                    'name' => $student->name . ' ' . $student->lastnames,
                    'institution' => $student->userData->receivingEntity->name ?? 'Sin institución asignada',
                    'career' => $student->userData->careers->name ?? 'Sin carrera',
                    'semester' => $student->userData->semesters->semester ?? 'Sin semestre',
                    'grade' => $student->userData->grades->grade ?? 'Sin grado',
                    'date' => $visitToShow->date ?? 'Sin Fecha',
                    'time' => $visitToShow->time ?? 'Sin Hora',
                    'visits_made' => $visitsMade,
                    'required_visits' => $requiredVisits,
                    'tutor_students_id' => $tutorStudentId,
                    'visit_action' => $visitAction,
                    'visit_button_text' => $visitButtonText,
                    'second_visit_completed' => $secondVisitCompleted,
                    'visit_id' => $visitId,
                    'is_dual' => $isDual,
                    'is_complete' => $visitToShow ? (bool) $visitToShow->is_complete : false
                ];
            })->filter()->values(); // para quitar nulls

            // Para admin/gestor mostrar lista simple
            if ($authUser->hasAnyRole(['admin', 'gestor-teacher'])) {
                $teacher->students_list = $studentsData->pluck('name')->implode(', ');
            } else {
                // Para tutor mostrar datos completos
                $teacher->students_list = $studentsData;
            }

            return $teacher;
        });

        $hasStudents = $studentTutor->pluck('students_list')->flatten();

        return view('livewire.filters.tutor-filter', [
            'studentTutor' => $studentTutor,
            'hasStudents' => $hasStudents,
        ]);
    }
}
