<?php

namespace App\Http\Livewire\Modals;

use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FileModal extends Component
{

    use WithFileUploads;

    public $isOpen = false;
    public $file;
    public $type = 'student';

    public $inserted = 0;
    public $duplicates = 0;

    public $listeners = ['loadFile' => 'openModal'];

    public function save($type = null)
    {

        if ($type) {
            $this->type = $type;
        }

        $this->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ], [
            'file.required' => 'Debes seleccionar un archivo.',
            'file.mimes' => 'El archivo debe ser XLSX o CSV.',
            'file.max' => 'El archivo no puede exceder 2MB.'
        ]);

        try {
            if ($this->type === 'student') {

                $import = new StudentsImport;
                Excel::import($import, $this->file->getRealPath());

                $inserted = $import->inserted;
                $duplicates = $import->duplicates;

                $this->dispatchBrowserEvent('notify', [
                    'type' => 'success',
                    'message' => "Estudiantes importados correctamente. | Total: $inserted | Duplicados: $duplicates"
                ]);
            } else {

                $import = new TeachersImport;
                Excel::import($import, $this->file->getRealPath());

                $inserted = $import->inserted;
                $duplicates = $import->duplicates;

                $this->dispatchBrowserEvent('notify', [
                    'type' => 'success',
                    'message' => "Docentes importados correctamente. | Total: $inserted | Duplicados: $duplicates"
                ]);
            }

            $this->closeModal();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $messages = collect($failures)->map(fn($f) => "Fila {$f->row()}: " . implode(', ', $f->errors()))->toArray();
            $this->closeModal();
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => implode('<br>', $messages)
            ]);
        } catch (QueryException $e) {
            // Captura de duplicados
            if ($e->errorInfo[1] == 1062) {
                $this->dispatchBrowserEvent('notify', [
                    'type' => 'error',
                    'message' => "Algunos datos ya existen en la base de datos y no fueron insertados."
                ]);
            } else {
                $this->dispatchBrowserEvent('notify', [
                    'type' => 'error',
                    'message' => "Error en la BD: " . $e->getMessage()
                ]);
            }
            $this->closeModal();
        } catch (\Throwable $e) {
            $this->closeModal();
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => "Error en la importación: " . $e->getMessage()
            ]);
        }
    }

    public function openModal($type = 'Estudiantes')
    {
        $this->type = $type;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->reset(['file', 'type']);
        $this->dispatchBrowserEvent('reset-file-previews');
        $this->dispatchBrowserEvent('reset-tabs', ['type' => $this->type]);
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modals.file-modal');
    }
}
