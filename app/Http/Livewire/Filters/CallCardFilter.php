<?php

namespace App\Http\Livewire\Filters;

use App\Models\ApplicationCall;
use Livewire\Component;

class CallCardFilter extends Component
{
    public $calls;

    public $listeners = ['refreshTutorFilter' => '$refresh'];

    public function render()
    {
        $this->calls = ApplicationCall::byUserCareer(auth()->user())->get();

        return view('livewire.filters.call-card-filter');
    }
}
