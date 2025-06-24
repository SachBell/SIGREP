<?php

namespace App\Http\Livewire\Filters;

use App\Models\ApplicationDetail;
use Livewire\Component;

class PostsFilter extends Component
{

    public $search = '';
    // public $userData;

    public function render()
    {
        $user = auth()->user();
        $careerId = $user->getCareerIdForScope();

        $appDetail = ApplicationDetail::with('receivingEntities')
            ->when($careerId, function ($q) use ($careerId) {
                $q->whereHas('userData', function ($q) use ($careerId) {
                    $q->where('career_id', $careerId);
                });
            })
            ->where(function ($q) {
                $q->whereHas('userData.profiles', function ($userData) {
                    $userData->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('lastnames', 'like', '%' . $this->search . '%')
                        ->orWhere('id_card', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                    ;
                })
                    ->orWhereHas('receivingEntities', function ($entity) {
                        $entity->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('UserData.careers', function ($data) {
                        $data->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('UserData.semesters', function ($semester) {
                        $semester->where('semester', 'like', '%' . $this->search . '%');
                    });
            })->get();

        return view('livewire.filters.posts-filter', compact('appDetail'));
    }
}
