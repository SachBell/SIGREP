<?php

namespace App\Http\Livewire\Modals;

use App\Helpers\EmailTemplateHelper;
use App\Mail\TutorAssignmentMail;
use App\Models\TeacherProfile;
use App\Models\UserData;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Mail;

class AssignStudentsModal extends GlobalModal
{

    public $selectedStudents = [];
    public $students = [];
    public $selectAll = false;

    protected $listeners = [
        'openCreate',
        'openEdit',
        'delete',
    ];

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $query = UserProfile::with([
            'userData.careers',
            'userData.semesters',
            'userData.grades',
            'tutor'
        ])->whereHas('userData.applicationDetail');

        if (auth()->user()->hasRole(['gestor-teacher'])) {
            $careerId = auth()->user()->getCareerIdForScope();
            $query->whereHas('userData', function ($q) use ($careerId) {
                $q->where('career_id', $careerId);
            });
        } elseif (auth()->user()->hasRole('admin') && $this->entityID) {
            // Para admin, filtrar por la carrera del docente tutor cuando se está editando
            $careerId = TeacherProfile::find($this->entityID)->career_id;
            $query->whereHas('userData', function ($q) use ($careerId) {
                $q->where('career_id', $careerId);
            });
        }

        $query->whereDoesntHave('tutor', function ($q) {
            // Excluimos la relación con el tutor actual si estamos editando
            if ($this->entityID) {
                $q->where('teacher_profile_id', '!=', $this->entityID);
            }
        });

        $this->students = $query->get();
    }

    public function modelClass(): string
    {
        return TeacherProfile::class;
    }

    public function rules()
    {
        return [
            'selectedStudents' => [
                'sometimes',
                'array',
            ],
            'selectedStudents.*' => [
                'integer',
                'exists:user_profiles,id',
                function ($attribute, $value, $fail) {
                    $userData = UserData::where('profile_id', $value)->first();

                    if (!$userData || !$userData->applicationDetail) {
                        $fail('El estudiante seleccionado no tiene postulaciones registradas.');
                    }
                }
            ],
        ];
    }

    public function authorizeAction($action, $model = null)
    {
        if (auth()->user()->hasRole('gestor-teacher') && $model) {
            return $model->career_id == auth()->user()->getCareerIdForScope();
        }

        return auth()->user()->hasAnyRole(['admin', 'gestor-teacher']);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('tutor-student.index');
    }

    public function openEdit($id)
    {
        $this->entityID = $id;
        $this->model = TeacherProfile::with(['students', 'career'])->findOrFail($id);

        $this->authorizeAction('update', $this->model);
        $this->formData = $this->model->toArray();

        // Cargar estudiantes ya asignados
        $this->selectedStudents = $this->model->students->pluck('id')->toArray();

        // Recargar estudiantes para asegurar consistencia
        $this->loadStudents();

        // Verificar si todos están seleccionados
        $this->selectAll = !empty($this->selectedStudents) &&
            count(array_intersect(
                $this->students->pluck('id')->toArray(),
                $this->selectedStudents
            )) === $this->students->count();

        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $studentsWithoutApplications = UserData::whereIn('id', $this->selectedStudents)
            ->whereDoesntHave('applicationDetail')
            ->count();

        if ($studentsWithoutApplications > 0) {
            $this->addError('selectedStudents', 'Uno o más estudiantes seleccionados no tienen postulaciones registradas.');
            return;
        }

        if ($this->entityID) {
            $this->model->students()->sync($this->selectedStudents);

            $tutor = $this->model;
            $assignedStudents = UserProfile::whereIn('id', $this->selectedStudents)->get();

            $this->notifyStudentsOfTutorAssignment($tutor, $assignedStudents);
        }

        $this->closeModal();
        $this->emit('refreshTutorFilter');
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Estudiantes actualizados exitosamente.'
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedStudents = array_unique(array_merge(
                $this->selectedStudents,
                $this->students->pluck('id')->toArray()
            ));
        } else {
            $this->selectedStudents = array_diff(
                $this->selectedStudents,
                $this->students->pluck('id')->toArray()
            );
        }
    }

    public function getShouldDisableSaveButtonProperty()
    {

        if ($this->entityID) {
            $currentStudents = $this->model->students->pluck('id')->toArray();
            sort($currentStudents);
            $selected = $this->selectedStudents;
            sort($selected);

            if ($currentStudents == $selected) {
                return true;
            }
        }

        return false;
    }

    public function updatedSelectedStudents()
    {
        $availableStudents = $this->students->pluck('id')->toArray();
        $selectedAvailable = array_intersect($this->selectedStudents, $availableStudents);

        $this->selectAll = !empty($availableStudents) &&
            count($selectedAvailable) === count($availableStudents);
    }

    public function render()
    {
        return view('livewire.modals.assign-students-modal');
    }

    protected function notifyStudentsOfTutorAssignment(TeacherProfile $tutor, $students)
    {
        if ($students->isEmpty()) {
            return;
        }

        $template = EmailTemplateHelper::get('tutor_assignment_student');
        if (!$template) {
            return;
        }

        foreach ($students as $student) {
            $subject = EmailTemplateHelper::renderSubject('tutor_assignment_student', [
                'student_name' => $student->name,
                'tutor_name' => $tutor->user->name,
            ]);

            $body = EmailTemplateHelper::renderBody('tutor_assignment_student', [
                'student_name' => $student->name,
                'tutor_name' => $tutor->user->name,
                'career' => $tutor->career->name,
            ]);

            $actionText = EmailTemplateHelper::renderAction('tutor_assignment_student', [
                'student_name' => $student->name,
                'tutor_name' => $tutor->user->name,
            ]);

            Mail::to($student->user->email)->send(
                new TutorAssignmentMail(
                    $subject,
                    $body,
                    route('progres.index'),
                    $actionText,
                    $student->name
                )
            );
        }

        $studentListHtml = '<ul>' . collect($students)
            ->map(function ($student) {
                return "<li>{$student->id_card} - {$student->name} {$student->lastnames}</li>";
            })
            ->join('') . '</ul>';

        $tutorSubject = EmailTemplateHelper::renderSubject('tutor_assignment_teacher', [
            'tutor_name' => $tutor->user->name,
        ]);

        $tutorBody = EmailTemplateHelper::renderBody('tutor_assignment_teacher', [
            'tutor_name' => $tutor->user->name,
            'students_list' => $studentListHtml,
            'career' => $tutor->career->name,
        ]);

        $tutorAction = EmailTemplateHelper::renderAction('tutor_assignment_teacher', [
            'tutor_name' => $tutor->user->name,
        ]);

        Mail::to($tutor->user->email)->send(
            new TutorAssignmentMail(
                $tutorSubject,
                $tutorBody,
                route('tutor-student.index'),
                $tutorAction,
                $tutor->user->name
            )
        );
    }
}
