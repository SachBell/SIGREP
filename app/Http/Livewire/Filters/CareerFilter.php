<?php

namespace App\Http\Livewire\Filters;

use App\Models\Career;
use Livewire\Component;

class CareerFilter extends Component
{
    public $search = '';
    public $selectedType;
    public $types = [];

    protected $listeners = ['refreshTutorFilter' => '$refresh'];

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
            })->paginate(10);

        return view('livewire.filters.career-filter', compact('careers'));
    }
}
