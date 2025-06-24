<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

abstract class GlobalModal extends Component
{
    public $isOpen = false;
    public $formData = [];
    public $entityID = null;
    public $model = null;

    protected $listeners = ['openCreate', 'openEdit'];

    abstract public function rules();
    abstract public function modelClass(): string;
    abstract public function authorizeAction($action, $model = null);
    abstract public function redirectAfterSave(): ?string;

    public function openCreate()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function openEdit($id)
    {
        $this->entityID = $id;
        $model = $this->modelClass()::findOrFail($id);
        $this->authorizeAction('update', $model);
        $this->formData = $model->toArray();
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $modelClass = $this->modelClass();

        if ($this->entityID) {
            $this->model = $modelClass::findOrFail($this->entityID);
            $this->authorizeAction('update', $this->model);
            $this->model->update($this->formData);
        } else {
            $this->authorizeAction('create');
            $this->model = $modelClass::create($this->formData);
        }

        $this->closeModal();

        if ($route = $this->redirectAfterSave()) {
            return $this->redirectRoute($route);
        }

        $this->emit('modalSaved');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetForm()
    {
        $this->reset(['entityID', 'formData']);
    }
}
