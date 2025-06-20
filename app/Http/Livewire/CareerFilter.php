<?php

namespace App\Http\Livewire;

use App\Models\Career;
use Livewire\Component;

class CareerFilter extends Component
{
    public $search = '';
    public $selectedType;
    public $types = [];

    public function mount()
    {
        $this->types = Career::pluck('is_dual')->unique()->values()->toArray();
    }

    public function render()
    {

        $careers = Career::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when(!is_null($this->selectedType), function ($query){
                $query->where('is_dual', $this->selectedType);
            })->get();

        return view('livewire.career-filter', compact('careers'));
    }
}
