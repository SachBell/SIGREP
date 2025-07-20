<?php

namespace App\Http\Livewire\Filters;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersFilter extends Component
{
    public $search = '';
    public $role = '';
    public $roles = [];

    protected $listeners = ['refreshTutorFilter' => '$refresh'];

    public function mount()
    {
        $this->roles = Role::pluck('name')->toArray();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->role, function ($query) {
                $query->role($this->role);
            })
            ->paginate(10);

        return view('livewire.filters.users-filter', [
            'users' => $users,
        ]);
    }
}
