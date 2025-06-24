<?php

namespace App\Http\Livewire\Filters;

use App\Models\TeacherProfile;
use App\Models\TutorStudent;
use App\Models\TutorVisits;
use Livewire\Component;

class TutorFilter extends Component
{
    public $search = '';

    public function render()
    {
        $authUser = auth()->user();

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
        $studentTutor = $query->get()->map(function ($teacher) use ($authUser) {
            $studentsData = $teacher->students->map(function ($student) use ($teacher) {
                // Obtener visitas para este estudiante y tutor
                $visits = TutorVisits::where(
                    'tutor_student_id',
                    TutorStudent::where('teacher_profile_id', $teacher->id)
                        ->where('user_profile_id', $student->id)
                        ->first()->id ?? null
                )->count();

                return [
                    'id' => $student->id,
                    'name' => $student->name . ' ' . $student->lastnames,
                    'institution' => $student->userData->receivingEntity->name ?? 'Sin institución asignada',
                    'career' => $student->userData->careers->name ?? 'Sin carrera',
                    'semester' => $student->userData->semesters->semester ?? 'Sin semestre',
                    'grade' => $student->userData->grades->grade ?? 'Sin grado',
                    'visits_made' => $visits,
                    'required_visits' => $student->userData->careers->is_dual ? 2 : 1,
                    'tutor_student_id' => TutorStudent::where('teacher_profile_id', $teacher->id)
                        ->where('user_profile_id', $student->id)
                        ->first()->id ?? null
                ];
            });

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
