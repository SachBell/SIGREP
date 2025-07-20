<?php

namespace App\Http\Livewire\Modals;

use App\Models\ApplicationCall;
use App\Models\ReceivingEntity;
use App\Models\ApplicationDetail;

class ApplicationModal extends GlobalModal
{
    public $selectedCall;
    public $institutes;
    public $selectedInstitute;
    public $userFullname;

    protected $listeners = [
        'openApplicationModal' => 'openApplication',
    ];

    public function mount()
    {
        $this->institutes = ReceivingEntity::byEntityCareer(auth()->user())->get();
        $this->userFullname = auth()->user()->profile->name . ' ' . auth()->user()->profile->lastnames;
    }

    public function modelClass(): string
    {
        return ApplicationDetail::class;
    }

    public function rules()
    {
        return [
            'selectedInstitute' => 'required|exists:receiving_entities,id',
        ];
    }

    public function authorizeAction($action, $model = null)
    {
        // Solo estudiantes pueden postular
        return auth()->user()->hasRole('student');
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('progres.index');
    }

    public function openApplication($callId)
    {
        $this->selectedCall = ApplicationCall::findOrFail($callId);
        $this->openCreate(); // Usa el método de GlobalModal
    }

    public function save()
    {
        $this->validate();

        // Verificar si ya está postulado
        $alreadyApplied = ApplicationDetail::where([
            'user_data_id' => auth()->user()->profile->userData->id,
            'application_calls_id' => $this->selectedCall->id
        ])->exists();

        if ($alreadyApplied) {
            $this->addError('selectedInstitute', 'Ya te has postulado a esta convocatoria');
            return;
        }

        ApplicationDetail::create([
            'user_data_id' => auth()->user()->profile->userData->id,
            'application_calls_id' => $this->selectedCall->id,
            'receiving_entity_id' => $this->selectedInstitute,
            'status_individual' => 'En Progreso',
        ]);

        $this->closeModal();
        $this->redirectAfterSave();
    }

    public function getInstituteAddressProperty()
    {
        if (!$this->selectedInstitute) return '';
        return $this->institutes->firstWhere('id', $this->selectedInstitute)->address ?? '';
    }
}
