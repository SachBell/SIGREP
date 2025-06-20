<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersFilter extends Component
{
    public $search = '';
    public $role = '';
    public $roles = [];

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
            ->get();

        return view('livewire.users-filter', [
            'users' => $users,
        ]);
    }
}
