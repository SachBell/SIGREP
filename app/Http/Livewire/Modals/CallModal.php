<?php

namespace App\Http\Livewire\Modals;

use App\Models\ApplicationCall;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CallModal extends GlobalModal
{
    use AuthorizesRequests;

    public $callId;
    public $name;
    public $start_date;
    public $end_date;
    public $career;

    public function mount($callId = null)
    {
        $this->callId = $callId;

        if ($callId) {
            $call = ApplicationCall::findOrFail($callId);
            $this->name = $call->name;
            $this->start_date = $call->start_date;
            $this->end_date = $call->end_date;
            $this->career = $call->career_id;
        }
    }

    public function modelClass(): string
    {
        return ApplicationCall::class;
    }

    public function rules()
    {
        $user = auth()->user();
        $unique = 'unique:application_calls,name';
        if ($this->entityID) {
            $unique .= ',' . $this->entityID;
        }

        $rules = [
            'formData.name' => ['required', 'string', 'max:255', $unique],
            'formData.start_date' => ['required', 'date'],
            'formData.end_date' => ['required', 'date', 'after_or_equal:formData.start_date'],
        ];

        if ($user->hasRole('admin')) {
            $rules['formData.career_id'] = ['required', 'exists:careers,id'];
        }

        return $rules;
    }

    public function authorizeAction($action, $model = null)
    {
        if ($model) {
            $this->authorize($action, $model);
        } else {
            $this->authorize($action, ApplicationCall::class);
        }
    }

    public function save()
    {
        $user = auth()->user();

        // Validación personalizada
        $this->validate();

        if (!$user->hasRole('admin')) {
            $this->formData['career_id'] = $user->getCareerIdForScope();
        }

        parent::save(); // Usa la lógica del GlobalFormModal
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('app-calls.index');
    }

    public function render()
    {
        return view('livewire.modals.call-modal');
    }
}
