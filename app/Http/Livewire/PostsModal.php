<?php

namespace App\Http\Livewire;

use App\Models\ApplicationCall;
use App\Models\ApplicationDetail;
use App\Models\ReceivingEntity;
use App\Models\UserData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;

class PostsModal extends GlobalModal
{
    use AuthorizesRequests;

    public Collection $entities;
    public Collection $calls;
    public array $selectedStudents = [];
    public Collection $students;
    public int $maxStudents = 0;
    public int $alreadyAssigned = 0;
    public $selectedCall = null;
    public $selectedEntity = null;
    public bool $selectAll = false;
    public $currentAssignment = null;
    public bool $isEditMode = false;

    public function mount($entityID = null)
    {
        $this->entityID = $entityID;
        $this->calls = ApplicationCall::byUserCareer(auth()->user())->get();
        $this->entities = ReceivingEntity::byEntityCareer(auth()->user())->get();
        $this->students = collect();
        $this->calculateAvailableSlots();
    }

    public function modelClass(): string
    {
        return ApplicationDetail::class;
    }

    public function rules()
    {
        $rules = [
            'selectedCall' => 'required|exists:application_calls,id',
            'selectedEntity' => 'required|exists:receiving_entities,id',
        ];

        if (!$this->isEditMode) {
            $rules['selectedStudents'] = [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('Debe seleccionar al menos un estudiante.');
                        return;
                    }

                    $total = count($value);
                    if ($total > $this->maxStudents) {
                        $remaining = $this->maxStudents - $this->alreadyAssigned;
                        $fail("La entidad solo tiene {$remaining} cupo(s) disponibles de {$this->maxStudents}.");
                    }
                }
            ];
            $rules['selectedStudents.*'] = 'exists:user_data,id';
        }

        return $rules;
    }

    public function openEdit($id)
    {
        $this->calculateAvailableSlots();
        $this->isEditMode = true;
        $this->entityID = $id;
        $this->currentAssignment = ApplicationDetail::with(['userData', 'receivingEntities'])->findOrFail($id);
        $this->authorizeAction('update', $this->currentAssignment);

        $this->selectedCall = $this->currentAssignment->application_calls_id;
        $this->selectedEntity = $this->currentAssignment->receiving_entity_id;

        // En modo edición, seleccionamos solo este estudiante
        $this->selectedStudents = [$this->currentAssignment->user_data_id];

        $this->isOpen = true;
    }

    public function updatedSelectedEntity($entityId)
    {
        if ($entityId) {
            $this->loadStudentsForEntity($entityId);
            $this->calculateAvailableSlots();
        }
    }

    public function updatedSelectedCall()
    {
        if ($this->selectedEntity) {
            $this->calculateAvailableSlots();
        }
    }

    public function updatedSelectedStudents()
    {
        $this->selectAll = count($this->selectedStudents) >= min($this->maxStudents, $this->students->count());
        $this->calculateAvailableSlots();
    }

    protected function loadStudentsForEntity($entityId)
    {
        $this->calculateAvailableSlots();

        $entity = ReceivingEntity::with('careers')->find($entityId);
        $this->maxStudents = $entity->user_limit;

        $careerIds = $entity->careers->pluck('id');

        if ($this->isEditMode) {
            // En modo edición, solo mostramos el estudiante actual
            $this->students = UserData::with(['profiles', 'careers', 'semesters', 'grades'])
                ->where('id', $this->currentAssignment->user_data_id)
                ->get();
        } else {
            // Modo normal: obtener estudiantes disponibles
            $this->selectedStudents = ApplicationDetail::where('receiving_entity_id', $entityId)
                ->when($this->selectedCall, fn($q) => $q->where('application_calls_id', $this->selectedCall))
                ->pluck('user_data_id')
                ->toArray();

            $query = UserData::with(['profiles', 'careers', 'semesters', 'grades'])
                ->whereIn('career_id', $careerIds)
                ->whereDoesntHave('applicationDetail', function ($q) {
                    $q->when($this->selectedCall, fn($q) => $q->where('application_calls_id', $this->selectedCall));
                });

            if (!auth()->user()->hasRole('admin')) {
                $careerId = auth()->user()->teacherProfile->career_id;
                $query->where('career_id', $careerId);
            }

            $this->students = $query->get();
        }
    }

    protected function calculateAvailableSlots()
    {
        if (!$this->selectedEntity) {
            $this->availableSlots = 0;
            $this->maxStudents = 0;
            $this->alreadyAssigned = 0;
            return 0;
        }

        $entity = ReceivingEntity::find($this->selectedEntity);
        $this->maxStudents = $entity->user_limit ?? 0;

        // Contar todas las asignaciones a esta entidad en el periodo seleccionado
        $query = ApplicationDetail::where('receiving_entity_id', $this->selectedEntity)
            ->when($this->selectedCall, fn($q) => $q->where('application_calls_id', $this->selectedCall));

        // En modo edición:
        if ($this->isEditMode && $this->currentAssignment) {
            // Si estamos cambiando a una entidad diferente, contar todas las asignaciones
            if ($this->currentAssignment->receiving_entity_id != $this->selectedEntity) {
                $this->alreadyAssigned = $query->count();
                $this->availableSlots = max(0, $this->maxStudents - $this->alreadyAssigned);
            }
            // Si estamos en la misma entidad, excluir esta asignación del conteo
            else {
                $this->alreadyAssigned = $query->where('id', '!=', $this->currentAssignment->id)->count();
                $this->availableSlots = max(0, $this->maxStudents - $this->alreadyAssigned - 1);
            }
        }
        // Modo creación
        else {
            $this->alreadyAssigned = $query->count();
            $this->availableSlots = max(0, $this->maxStudents - $this->alreadyAssigned);
        }

        return $this->availableSlots;
    }

    public function toggleStudentSelection($studentId)
    {
        if (in_array($studentId, $this->selectedStudents)) {
            $this->selectedStudents = array_filter($this->selectedStudents, fn($id) => $id != $studentId);
        } else {
            $total = $this->alreadyAssigned + count($this->selectedStudents);
            if ($total < $this->maxStudents) {
                $this->selectedStudents[] = $studentId;
            }
        }

        $this->calculateAvailableSlots();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            // Validar que no exista ya esta asignación
            $exists = ApplicationDetail::where('user_data_id', $this->currentAssignment->user_data_id)
                ->where('application_calls_id', $this->selectedCall)
                ->where('receiving_entity_id', $this->selectedEntity)
                ->where('id', '!=', $this->currentAssignment->id)
                ->exists();

            if ($exists) {
                $this->addError('selectedEntity', 'Este estudiante ya está asignado a esta entidad en el periodo seleccionado');
                return;
            }

            $this->currentAssignment->update([
                'application_calls_id' => $this->selectedCall,
                'receiving_entity_id' => $this->selectedEntity,
                'assigned_by' => auth()->id()
            ]);
        } else {
            // Lógica original para creación masiva
            $existingAssignments = $this->getExistingAssignments();
            $toAdd = array_diff($this->selectedStudents, $existingAssignments);
            $toRemove = array_diff($existingAssignments, $this->selectedStudents);

            if (!empty($toRemove)) {
                ApplicationDetail::where('receiving_entity_id', $this->selectedEntity)
                    ->where('application_calls_id', $this->selectedCall)
                    ->whereIn('user_data_id', $toRemove)
                    ->delete();
            }

            foreach ($toAdd as $studentId) {
                ApplicationDetail::create([
                    'user_data_id' => $studentId,
                    'application_calls_id' => $this->selectedCall,
                    'receiving_entity_id' => $this->selectedEntity,
                    'status_individual' => 'En Progreso',
                    'assigned_by' => auth()->id()
                ]);
            }
        }

        $this->emit('showToast', 'success', $this->isEditMode ? 'Postulación actualizada' : 'Asignaciones guardadas');
        $this->closeModal();
        $this->redirectAfterSave();
    }

    public function closeModal()
    {
        $this->isEditMode = false;
        $this->currentAssignment = null;
        $this->reset(['selectedStudents', 'selectedCall', 'selectedEntity']);
        parent::closeModal();
    }

    public function authorizeAction($action, $model = null)
    {
        $this->authorize($action, $model ?? ApplicationDetail::class);
    }

    protected function getExistingAssignments()
    {
        if (!$this->selectedEntity || !$this->selectedCall) {
            return [];
        }

        return ApplicationDetail::where('receiving_entity_id', $this->selectedEntity)
            ->where('application_calls_id', $this->selectedCall)
            ->pluck('user_data_id')
            ->toArray();
    }

    public function getShouldDisableSaveButtonProperty()
    {
        // Validaciones básicas
        if (!$this->selectedCall || !$this->selectedEntity) {
            return true;
        }

        // En modo edición
        if ($this->isEditMode) {
            // Si no hay cambios, deshabilitar (misma entidad y mismo periodo)
            if (
                $this->currentAssignment->receiving_entity_id == $this->selectedEntity &&
                $this->currentAssignment->application_calls_id == $this->selectedCall
            ) {
                return true;
            }

            // Validar límite solo si estamos cambiando a una entidad diferente
            if ($this->currentAssignment->receiving_entity_id != $this->selectedEntity) {
                return $this->availableSlots <= 0;
            }

            return false;
        }

        // En modo creación
        return count($this->selectedStudents) === 0 || $this->availableSlots <= 0;
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('student-posts.index');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $remainingSlots = max(0, $this->maxStudents - count($this->selectedStudents));
            $studentsToAdd = $this->students
                ->pluck('id')
                ->diff($this->selectedStudents)
                ->take($remainingSlots)
                ->toArray();

            $this->selectedStudents = array_merge($this->selectedStudents, $studentsToAdd);
        } else {
            $previouslyAssigned = ApplicationDetail::where('receiving_entity_id', $this->selectedEntity)
                ->when($this->selectedCall, fn($q) => $q->where('application_calls_id', $this->selectedCall))
                ->pluck('user_data_id')
                ->toArray();

            $this->selectedStudents = array_intersect($this->selectedStudents, $previouslyAssigned);
        }

        $this->calculateAvailableSlots();
    }

    public function getSelectedEntityAddressProperty()
    {
        return $this->selectedEntity
            ? optional($this->entities->firstWhere('id', $this->selectedEntity))->address
            : '';
    }

    public function render()
    {
        $this->calculateAvailableSlots();
        return view('livewire.posts-modal');
    }
}
