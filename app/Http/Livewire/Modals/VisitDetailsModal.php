<?php

namespace App\Http\Livewire\Modals;

use App\Models\TutorVisits;
use Livewire\Component;

class VisitDetailsModal extends GlobalModal
{

    public $tutorStudentID;
    public $visitID;
    public $formData = [];

    protected $listeners = [
        'openEditVisit' => 'openEdit', // para editar visita con visit_id
    ];

    public function mount($visitID = null, $tutorStudentID = null)
    {
        $this->resetForm();
        $this->visitID = $visitID;
        $this->tutorStudentID = $tutorStudentID;

        if ($visitID) {
            $this->loadEditData($visitID);
        }
    }

    public function openEdit($visitID)
    {
        $this->resetForm();
        $this->visitID = $visitID;
        $this->model = TutorVisits::findOrFail($visitID);
        $this->loadEditData($visitID);
        $this->isOpen = true;
    }

    protected function loadEditData($id)
    {
        $this->model = TutorVisits::findOrFail($id);
        $this->authorizeAction('update', $this->model);

        $this->formData = [
            'date' => $this->model->date,
            'time' => $this->model->time,
            'observation' => $this->model->observation,
            'is_completed' => $this->model->is_completed,
        ];

        $this->tutorStudentID = $this->model->tutor_students_id;
        $this->isOpen = true;
    }

    public function rules()
    {
        return [
            'formData.observation' => ['nullable', 'string', 'max:1000'],
            'formData.is_complete' => ['required', 'boolean'],
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->visitID) {
            $this->model->update([
                'observation' => $this->formData['observation'],
                'is_complete' => $this->formData['is_complete'],
            ]);
        } else {
            // Solo si en algún caso extraño no hay ID, creamos (aunque en este modal no debería ocurrir)
            TutorVisits::create([
                'tutor_students_id' => $this->tutorStudentID,
                'observation' => $this->formData['observation'],
                'is_complete' => $this->formData['is_complete'],
            ]);
        }

        $this->closeModal();
        $this->redirectAfterSave();
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Visita actualizada correctamente.'
        ]);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('tutor-student.index');
    }

    public function authorizeAction($action, $model = null)
    {
        return true;
    }

    public function modelClass(): string
    {
        return TutorVisits::class;
    }

    public function render()
    {
        return view('livewire.modals.visit-details-modal');
    }
}
