<?php

namespace App\Http\Livewire\Modals;

use App\Models\FinalGrade;
use App\Models\TutorStudent;
use Livewire\Component;

class FinalGradeModal extends Component
{
    public $isOpen = false;
    public $tutorStudentId;
    public $grade;
    public $observations;

    public $canBeRated = false;
    public $errorMessage;
    public $visitHistory = [];

    protected $listeners = ['openFinalGradeModal' => 'loadModal'];

    public function mount($tutorStudentId = null)
    {
        if ($tutorStudentId) {
            $this->loadModal($tutorStudentId);
        }
    }

    public function loadModal($id)
    {
        $this->resetValidation();
        $this->reset(['grade', 'observations', 'errorMessage', 'canBeRated']);

        $this->tutorStudentId = $id;

        $ts = TutorStudent::with([
            'userData.userData.careers',
            'userData.userData.semesters',
            'userData.userData.grades',
            'userData.userData.applicationDetail',
            'profiles',
            'finalGrade',
            'visits',
        ])->find($id);

        if (!$ts) {
            $this->errorMessage = 'Este estudiante no está asignado a un docente tutor aún.';
            $this->isOpen = true;
            return;
        }

        // Cargar datos previos si existen
        $existing = $ts->finalGrade;
        if ($existing) {
            $this->grade = $existing->grade;
            $this->observations = $existing->observations;
        }

        // Validar visitas
        $isDual = $ts->userData->userData->careers->is_dual ?? false;
        $completedVisits = $ts->visits->where('is_complete', true)->count();

        $this->canBeRated = ($isDual && $completedVisits >= 2) || (!$isDual && $completedVisits >= 1);

        if (!$this->canBeRated) {
            $this->errorMessage = 'Este estudiante aún no cumple con las visitas requeridas para ser calificado.';
        }

        $tutorName = optional($ts->profiles)->name ?? 'No asignado';

        $this->visitHistory = $ts->visits->map(function ($visit) use ($tutorName) {
            return [
                'date' => $visit->date,
                'time' => $visit->time,
                'observation' => $visit->observation,
                'tutor' => $tutorName,
                'is_complete' => $visit->is_complete,
            ];
        })->toArray();

        $this->isOpen = true;
    }

    public function save()
    {
        if (!$this->canBeRated) {
            session()->flash('error', 'No se puede guardar la calificación. Faltan visitas.');
            return;
        }

        // dd($this->tutorStudentId);

        $this->validate([
            'grade' => 'required|integer|min:0|max:10',
            'observations' => 'nullable|string|max:1000',
        ]);

        // dd($this->tutorStudentId);

        FinalGrade::updateOrCreate(
            ['tutor_student_id' => $this->tutorStudentId],
            ['grade' => $this->grade, 'observations' => $this->observations]
        );

        // Cambiar estado a 'finalizado'
        $ts = TutorStudent::findOrFail($this->tutorStudentId);
        $ts->userData->userData->applicationDetail->status_individual = 'Finalizado';
        $ts->userData->userData->applicationDetail->save();

        session()->flash('success', 'Calificación guardada correctamente y prácticas finalizadas.');

        $this->isOpen = false;

        $this->emitUp('refreshTutorFilter');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modals.final-grade-modal');
    }
}
