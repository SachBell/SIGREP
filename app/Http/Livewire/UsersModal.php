<?php

namespace App\Http\Livewire;

use App\Models\Career;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersModal extends GlobalModal
{
    use AuthorizesRequests;

    public $roles = [];
    public $careers = [];
    public $semesters = [];
    public $grades = [];
    public $selectedRole = null;

    public function mount($entityID = null)
    {
        $this->entityID = $entityID;
        $this->loadInitialData();

        if ($entityID) {
            $this->loadEditData($entityID);
        } else {
            $this->initializeEmptyForm();
        }
    }

    protected function loadInitialData()
    {
        $this->roles = Role::pluck('name', 'id')->toArray();
        $this->careers = Career::all();
        $this->semesters = Semester::all();
        $this->grades = Grade::all();
    }

    protected function loadEditData($userId)
    {
        $user = User::with([
            'profile.userData',
            'teacherProfile.career',
            'roles'
        ])->findOrFail($userId);

        $this->formData = [
            'username' => $user->name,
            'email' => $user->email,
        ];

        $this->selectedRole = $user->roles->first()->name ?? null;
        $this->loadRoleSpecificData($user);
    }

    protected function loadRoleSpecificData(User $user)
    {
        if ($this->selectedRole === 'student') {
            $this->loadStudentData($user);
        } elseif (in_array($this->selectedRole, ['tutor', 'gestor-teacher'])) {
            $this->loadTeacherData($user);
        }
    }

    protected function loadStudentData(User $user)
    {
        $profile = $user->profile;
        $userData = $profile?->userData;

        $this->formData = array_merge($this->formData, [
            'name' => $profile->name ?? '',
            'lastnames' => $profile->lastnames ?? '',
            'id_card' => $profile->id_card ?? '',
            'phone_number' => $profile->phone_number ?? '',
            'address' => $profile->address ?? '',
            'neighborhood' => $profile->neighborhood ?? '',
            'daytrip' => $userData->daytrip ?? '',
            'career' => $userData->career_id ?? '',
            'semester' => $userData->semester_id ?? '',
            'grade' => $userData->grade_id ?? '',
        ]);
    }

    protected function loadTeacherData(User $user)
    {
        $teacherProfile = $user->teacherProfile;

        $this->formData = array_merge($this->formData, [
            'name' => $teacherProfile->name ?? '',
            'lastnames' => $teacherProfile->lastname ?? '',
            'career' => $teacherProfile->career_id ?? '',
        ]);
    }

    protected function initializeEmptyForm()
    {
        $this->formData = [
            'username' => '',
            'email' => '',
            'password' => '',
            'name' => '',
            'lastnames' => '',
            'id_card' => '',
            'phone_number' => '',
            'address' => '',
            'neighborhood' => '',
            'daytrip' => '',
            'career' => '',
            'semester' => '',
            'grade' => '',
        ];
    }

    public function updatedSelectedRole($role)
    {
        $this->formData = array_merge($this->formData, [
            'name' => '',
            'lastnames' => '',
            'id_card' => '',
            'phone_number' => '',
            'address' => '',
            'neighborhood' => '',
            'daytrip' => '',
            'career' => '',
            'semester' => '',
            'grade' => '',
        ]);
    }

    public function openEdit($id)
    {
        $this->entityID = $id;
        $this->model = User::with([
            'profile.userData',
            'teacherProfile.career',
            'roles'
        ])->findOrFail($id);

        $this->authorizeAction('update', $this->model);

        $this->formData = [
            'username' => $this->model->name,
            'email' => $this->model->email,
        ];

        $this->selectedRole = $this->model->roles->first()->name ?? null;
        $this->loadRoleSpecificData($this->model);

        $this->isOpen = true;
    }

    public function modelClass(): string
    {
        return User::class;
    }

    public function rules()
    {
        $rules = [
            'formData.email' => ['required', 'email', $this->emailUniqueRule()],
            'formData.password' => [$this->entityID ? 'nullable' : 'required', 'string', 'min:8'],
            'selectedRole' => ['required', 'exists:roles,name'],
            'formData.username' => ['required', 'string', 'max:255'],
        ];

        if ($this->selectedRole === 'student') {
            $rules = array_merge($rules, [
                'formData.name' => ['required', 'string', 'max:255'],
                'formData.lastnames' => ['required', 'string', 'max:255'],
                'formData.id_card' => ['required', 'string', 'max:10', $this->idCardUniqueRule()],
                'formData.phone_number' => ['required', 'string', 'max:10'],
                'formData.address' => ['required', 'string', 'max:255'],
                'formData.neighborhood' => ['required', 'string', 'max:255'],
                'formData.daytrip' => ['required', 'in:Vespertina,Nocturna'],
                'formData.career' => ['required', 'exists:careers,id'],
                'formData.semester' => ['required', 'exists:semesters,id'],
                'formData.grade' => ['required', 'exists:grades,id'],
            ]);
        }

        if (in_array($this->selectedRole, ['tutor', 'gestor-teacher'])) {
            $rules = array_merge($rules, [
                'formData.name' => ['required', 'string', 'max:255'],
                'formData.lastnames' => ['required', 'string', 'max:255'],
                'formData.career' => ['required', 'exists:careers,id'],
            ]);
        }

        return $rules;
    }

    protected function emailUniqueRule()
    {
        $rule = 'unique:users,email';
        if ($this->entityID) {
            $rule .= ',' . $this->entityID;
        }
        return $rule;
    }

    protected function idCardUniqueRule()
    {
        // logger('Datos para validación id_card:', [
        //     'entityID' => $this->entityID,
        //     'model_exists' => isset($this->model),
        //     'profile_exists' => isset($this->model) && isset($this->model->profile),
        //     'profile_id' => isset($this->model->profile) ? $this->model->profile->id : null
        // ]);

        $rule = Rule::unique('user_profiles', 'id_card');

        if ($this->entityID && optional($this->model)->profile) {
            $rule->ignore($this->model->profile->id, 'id');
        }

        return $rule;
    }

    public function save()
    {
        // Depuración: ver qué datos llegan antes de validar
        // logger('Datos antes de validar:', [
        //     'formData' => $this->formData,
        //     'selectedRole' => $this->selectedRole
        // ]);

        $this->validate();

        $userData = [
            'name' => $this->formData['username'],
            'email' => $this->formData['email'],
        ];

        if (!empty($this->formData['password'])) {
            $userData['password'] = Hash::make($this->formData['password']);
        }

        // Crear o actualizar usuario
        $this->model = User::updateOrCreate(['id' => $this->entityID], $userData);

        // Asignar rol
        $this->model->syncRoles([$this->selectedRole]);

        // Manejar datos específicos por rol
        $this->handleRoleSpecificData();

        $this->closeModal();
        $this->redirectAfterSave();
    }

    protected function handleRoleSpecificData()
    {
        if ($this->selectedRole === 'student') {
            $this->handleStudentData();
        } elseif (in_array($this->selectedRole, ['tutor', 'gestor-teacher'])) {
            $this->handleTeacherData();
        }
    }

    protected function handleStudentData()
    {
        $profileData = [
            'name' => $this->formData['name'],
            'lastnames' => $this->formData['lastnames'],
            'id_card' => $this->formData['id_card'],
            'phone_number' => $this->formData['phone_number'],
            'address' => $this->formData['address'],
            'neighborhood' => $this->formData['neighborhood'],
        ];

        $userData = [
            'daytrip' => $this->formData['daytrip'],
            'career_id' => $this->formData['career'],
            'semester_id' => $this->formData['semester'],
            'grade_id' => $this->formData['grade'],
        ];

        // Actualizar o crear perfil
        $profile = $this->model->profile()->updateOrCreate(
            ['users_id' => $this->model->id],
            $profileData
        );

        // Actualizar o crear userData
        $profile->userData()->updateOrCreate(
            ['profile_id' => $profile->id],
            $userData
        );
    }

    protected function handleTeacherData()
    {
        $teacherData = [
            'name' => $this->formData['name'],
            'lastname' => $this->formData['lastnames'],
            'career_id' => $this->formData['career'],
            'users_id' => $this->model->id,
        ];

        $this->model->teacherProfile()->updateOrCreate(
            ['users_id' => $this->model->id],
            $teacherData
        );
    }

    public function authorizeAction($action, $model = null)
    {
        $this->authorize($action, $model ?? User::class);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('manage-users.index');
    }

    public function render()
    {
        return view('livewire.users-modal');
    }
}
