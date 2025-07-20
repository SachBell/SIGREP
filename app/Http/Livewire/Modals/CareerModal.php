<?php

namespace App\Http\Livewire\Modals;

use App\Models\Career;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CareerModal extends GlobalModal
{
    use AuthorizesRequests;

    public $entityID;
    public $is_dual = false;

    protected $listeners = [
        'openCreate',
        'openEdit',
        'delete',
    ];

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

        if ($this->entityID) {
            $career = Career::findOrFail($this->entityID);
            $career->update($this->formData);
        } else {
            Career::create($this->formData);
        }

        $this->closeModal();
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => $this->entityID ? 'Carrera actualizada exitosamente.' : 'Carrera creada exitosamente.'
        ]);

        $this->emit('refreshTutorFilter');
    }

    public function authorizeAction($action, $model = null)
    {
        $this->authorize($action, $model ?? Career::class);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('careers.index');
    }

    public function delete($id)
    {
        $career = Career::findOrFail($id);

        // $this->authorize('delete', $call);

        $career->delete();

        $this->emit('refreshTutorFilter');

        $this->dispatchBrowserEvent('notify', [
            'type' => 'error',
            'message' => 'Carrera eliminada exitosamente'
        ]);
    }

    public function render()
    {
        return view('livewire.modals.career-modal');
    }
}
