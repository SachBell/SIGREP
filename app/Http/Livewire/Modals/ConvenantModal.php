<?php

namespace App\Http\Livewire\Modals;

use App\Models\Career;
use App\Models\PrincipalData;
use App\Models\ReceivingEntity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ConvenantModal extends GlobalModal
{

    use AuthorizesRequests;

    public $career_id;
    public $careers = [];
    public $principalId = null;

    protected $listeners = [
        'openCreate',
        'openEdit',
        'delete',
    ];

    public function mount($entityID = null)
    {
        $this->entityID = $entityID;
        $this->careers = Career::all();

        if ($entityID) {
            $entity = ReceivingEntity::with(['principalData', 'careers'])->findOrFail($entityID);
            $this->formData = [
                'name' => $entity->name,
                'address' => $entity->address,
                'user_limit' => $entity->user_limit,
                'productive_sector' => $entity->productive_sector,
                'convenant_start_date' => $entity->convenant_start_date,
                'convenant_end_date' => $entity->convenant_end_date,
                'observations' => $entity->observations,
                'director_name' => optional($entity->principalData)->name ?? '',
                'director_lastname' => optional($entity->principalData)->lastname ?? '',
                'director_email' => optional($entity->principalData)->email ?? '',
                'director_id_card' => optional($entity->principalData)->id_card ?? '',
                'director_phone_number' => optional($entity->principalData)->phone_number ?? '',
                'career_id' => optional($entity->careers->first())->id ?? '',
            ];
            $this->principalId = optional($entity->principalData)->id;
            // logger('Proncipal' . $this->principalId);
        } else {
            $this->formData = [
                'name' => '',
                'address' => '',
                'user_limit' => '',
                'productive_sector' => '',
                'convenant_start_date' => '',
                'convenant_end_date' => '',
                'observations' => '',
                'director_name' => '',
                'director_lastname' => '',
                'director_email' => '',
                'director_id_card' => '',
                'director_phone_number' => '',
                'career_id' => '',
            ];
        }
    }

    public function openEdit($id)
    {
        $entity = ReceivingEntity::with(['principalData'])->findOrFail($id);

        $this->authorizeAction('update', $entity);

        $principal = $entity->principalData;

        $this->formData = [
            'name' => $entity->name ?? '',
            'address' => $entity->address ?? '',
            'user_limit' => $entity->user_limit ?? '',
            'productive_sector' => $entity->productive_sector ?? '',
            'convenant_start_date' => $entity->convenant_start_date ?? '',
            'convenant_end_date' => $entity->convenant_end_date ?? '',
            'observations' => $entity->observations ?? '',
            'director_name' => $principal->name ?? '',
            'director_lastname' => $principal->lastname ?? '',
            'director_email' => $principal->email ?? '',
            'director_id_card' => $principal->id_card ?? '',
            'director_phone_number' => $principal->phone_number ?? '',
            'career_id' => optional($entity->careers->first())->id ?? '',

        ];

        $this->principalId = optional($entity->principalData)->id;

        // logger('Proncipal' . $this->principalId);
        $this->entityID = $id;
        $this->isOpen = true;
    }

    public function modelClass(): string
    {
        return ReceivingEntity::class;
    }

    public function rules()
    {
        // logger('Entidad: ' . $this->principalId);

        $rules = [
            'formData.name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('receiving_entities', 'name')->ignore($this->entityID),
            ],
            'formData.address' => ['required', 'string', 'max:255'],
            'formData.user_limit' => ['required', 'string', 'max:255'],
            'formData.productive_sector' => ['required', 'string', 'max:255'],
            'formData.convenant_start_date' => ['required', 'date'],
            'formData.convenant_end_date' => ['required', 'date', 'after_or_equal:formData.convenant_start_date'],
            'formData.observations' => ['sometimes', 'string', 'max:255'],
            'formData.director_name' => ['required', 'string', 'max:255'],
            'formData.director_lastname' => ['required', 'string', 'max:255'],
            'formData.director_id_card' => [
                'required',
                'string',
                'max:10',
                Rule::unique('principal_data', 'id_card')->ignore($this->principalId, 'id'),
            ],
            'formData.director_phone_number' => [
                'required',
                'string',
                'max:10',
                Rule::unique('principal_data', 'phone_number')->ignore($this->principalId, 'id'),
            ],
            'formData.director_email' => ['required', 'email', 'max:255'],
        ];

        if (auth()->user()->hasRole('admin')) {
            $rules['formData.career_id'] = ['required', 'exists:careers,id'];
        }

        return $rules;
    }

    public function save()
    {
        if ($this->entityID && !$this->principalId) {
            // Refrescar el principalId en caso de que no esté
            $entity = ReceivingEntity::with('principalData')->find($this->entityID);
            $this->principalId = optional($entity->principalData)->id;
        }

        $this->validate();

        $careerId = auth()->user()->hasRole('admin')
            ? $this->formData['career_id'] ?? null
            : auth()->user()->getCareerIdForScope();

        if ($careerId) {
            $career = Career::find($careerId);

            if ($career && $career->is_dual && (empty($this->formData['user_limit']) || intval($this->formData['user_limit']) <= 0)) {
                throw ValidationException::withMessages([
                    'formData.user_limit' => 'Para carreras duales debe establecer un límite mayor a 0.',
                ]);
            }
        }

        try {
            DB::transaction(function () {

                if (!$this->entityID) {
                    // dd($this->formData);
                    $principal = PrincipalData::create([
                        'name' => $this->formData['director_name'],
                        'lastname' => $this->formData['director_lastname'],
                        'email' => $this->formData['director_email'],
                        'phone_number' => $this->formData['director_phone_number'],
                        'id_card' => $this->formData['director_id_card'],
                    ]);

                    $entity = new ReceivingEntity();
                    $entity->principal_data_id = $principal->id;
                } else {
                    $entity = ReceivingEntity::findOrFail($this->entityID);
                }

                $entity->fill($this->formData);
                $entity->save();

                if ($this->entityID) {
                    if ($entity->principalData) {
                        $entity->principalData->update([
                            'name' => $this->formData['director_name'],
                            'lastname' => $this->formData['director_lastname'],
                            'email' => $this->formData['director_email'],
                            'phone_number' => $this->formData['director_phone_number'],
                            'id_card' => $this->formData['director_id_card'],
                        ]);
                    } else {
                        $entity->principalData()->create([
                            'name' => $this->formData['director_name'],
                            'lastname' => $this->formData['director_lastname'],
                            'email' => $this->formData['director_email'],
                            'phone_number' => $this->formData['director_phone_number'],
                            'id_card' => $this->formData['director_id_card'],
                        ]);
                    }
                }

                $careerId = null;

                if (auth()->user()->hasRole('admin')) {
                    // Admin selecciona la carrera del formulario
                    $careerId = $this->formData['career_id'] ?? null;
                } else {
                    // Docente encargado usa su propia carrera
                    $careerId = auth()->user()->getCareerIdForScope();
                }

                if ($careerId) {
                    if ($this->entityID) {
                        // Edición: sincroniza la relación
                        $entity->careers()->sync([$careerId]);
                    } else {
                        // Creación: attach
                        $entity->careers()->attach($careerId);
                    }
                }
            });

            $this->closeModal();
            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => $this->entityID ? 'Convenio actualizado exitosamente.' : 'Convenio creado exitosamente.'
            ]);

            $this->emit('refreshTutorFilter');
        } catch (\Throwable $e) {
            logger()->error('Error al cargar el convenio: ' . $e->getMessage());

            throw ValidationException::withMessages([
                'formData.name' => 'Ocurrió un error al guardar la entidad. Por favor, intenta nuevamente.',
            ]);

            logger()->error('Principal ID: ' . $this->principalId);
            logger()->error('ReceivingEntity ID: ' . $this->entityID);
            logger()->error('Request data: ' . json_encode($this->formData));
        }
    }

    public function authorizeAction($action, $model = null)
    {
        $this->authorize($action, $model ?? ReceivingEntity::class);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('convenants.index');
    }

    public function delete($id)
    {
        $convenant = ReceivingEntity::findOrFail($id);
        $this->authorize('delete', $convenant);

        $convenant->delete();

        if ($convenant->principalData) {
            $convenant->principalData->delete();
        }

        $this->emit('refreshTutorFilter');

        $this->dispatchBrowserEvent('notify', [
            'type' => 'error',
            'message' => 'Convenio eliminado correctamente'
        ]);
    }

    public function render()
    {
        return view('livewire.modals.convenant-modal');
    }
}
