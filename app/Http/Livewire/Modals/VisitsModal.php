<?php

namespace App\Http\Livewire\Modals;

use App\Models\TutorStudent;
use App\Models\TutorVisits;

class VisitsModal extends GlobalModal
{

    public $tutorStudentID;
    public $modality;
    public $visitsMade = 0;
    public $requiredVisits = 1;

    public function mount($entityID = null, $tutorStudentID = null)
    {
        $this->entityID = $entityID;

        if ($entityID) {
            $this->loadEditData($entityID);
        } elseif ($tutorStudentID) {
            $this->loadCreateData($tutorStudentID);
        }
    }

    public function openCreate($tutorStudent = null)
    {
        $this->resetForm(); // limpia datos anteriores
        if ($tutorStudent) {
            $this->tutorStudentID = $tutorStudent;
            $this->loadCreateData($this->tutorStudentID);
        }
        $this->isOpen = true;
    }

    public function loadCreateData($tutorStudentID)
    {
        $this->tutorStudentID = $tutorStudentID;

        $tutorStudent = TutorStudent::with(['userData.userData.careers'])->withCount('visits')->findOrFail($tutorStudentID);

        $isDual = (bool) optional(optional($tutorStudent->userData)->userData?->careers)->is_dual;
        $this->modality = $isDual ? 'dual' : 'convencional';
        $this->requiredVisits = $isDual ? 2 : 1;
        $this->visitsMade = $tutorStudent->visits_count;

        if ($this->visitsMade >= $this->requiredVisits) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => "Ya se han registrado las {$this->requiredVisits} visitas requeridas para modalidad {$this->modality}."
            ]);
            $this->closeModal();
            return;
        }

        $this->formData = [
            'tutor_student_id' => $tutorStudentID,
            'date' => '',
            'time' => '',
            'observation' => '',
        ];

        $this->isOpen = true;
    }

    protected function loadEditData($id)
    {
        $this->model = TutorVisits::findOrFail($id);
        $this->authorizeAction('update', $this->model);

        $this->tutorStudentID = $this->model->tutor_students_id;
        $this->formData = [
            'date' => $this->model->date,
            'time' => $this->model->time,
            'observation' => $this->model->observation,
        ];

        $this->isOpen = true;
    }

    public function rules()
    {
        return [
            'formData.date' => ['required', 'date'],
            'formData.time' => ['required', 'date_format:H:i'],
            'formData.observation' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->formData['tutor_students_id'] = $this->tutorStudentID;

        // Validación lógica extra si es dual
        if (!$this->entityID && $this->visitsMade >= $this->requiredVisits) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => "Ya se han registrado las {$this->requiredVisits} visitas requeridas para modalidad {$this->modality}."
            ]);
            return;
        }

        parent::save();

        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => $this->entityID ? 'Visita actualizada.' : 'Visita registrada exitosamente.'
        ]);
    }

    public function redirectAfterSave(): ?string
    {
        return null;
    }

    public function authorizeAction($action, $model = null)
    {
        if (auth()->user()->hasRole('tutor') && $model) {
            return $model->career_id == auth()->user()->getCareerIdForScope();
        }
    }

    public function modelClass(): string
    {
        return TutorVisits::class;
    }

    public function render()
    {
        return view('livewire.modals.visits-modal');
    }
}
