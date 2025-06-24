<?php

namespace App\Http\Livewire\Modals;

use App\Models\Career;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CareerModal extends GlobalModal
{
    use AuthorizesRequests;

    public $is_dual = false;

    public function mount($entityID = null)
    {
        $this->entityID = $entityID;

        if ($entityID) {
            $career = Career::findOrFail($entityID);
            $this->formData = [
                'name' => $career->name,
                'is_dual' => $career->is_dual,
            ];
        } else {
            $this->formData = [
                'name' => '',
                'is_dual' => false,
            ];
        }
    }

    public function modelClass(): string
    {
        return Career::class;
    }

    public function rules()
    {
        $unique = 'unique:careers,name';
        if ($this->entityID) {
            $unique .= ',' . $this->entityID;
        }

        return [
            'formData.name' => ['required', 'string', 'max:255', $unique],
            'formData.is_dual' => ['required', 'boolean'],
        ];
    }

    public function save()
    {
        // Validación personalizada
        $this->validate();

        parent::save(); // Usa la lógica del GlobalFormModal
    }

    public function authorizeAction($action, $model = null)
    {
        $this->authorize($action, $model ?? Career::class);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('careers.index');
    }

    public function render()
    {
        return view('livewire.modals.career-modal');
    }
}
