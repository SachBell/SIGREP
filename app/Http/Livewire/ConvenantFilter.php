<?php

namespace App\Http\Livewire;

use App\Models\Career;
use App\Models\ReceivingEntity;
use Livewire\Component;

class ConvenantFilter extends Component
{

    public $search = '';
    public $name;
    public $address;
    public $productive_sector;
    public $convenant_start_date;
    public $convenant_end_date;
    public $career = '';
    public $careers = [];

    public function mount()
    {
        $this->careers = Career::pluck('name', 'id')->toArray();
    }

    public function render()
    {

        $search = $this->search;

        $convenants = ReceivingEntity::byEntityCareer(auth()->user())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('productive_sector', 'like', '%' . $search . '%')
                        ->orWhereDate('convenant_start_date', 'like', '%' . $search . '%')
                        ->orWhereDate('convenant_end_date', 'like', '%' . $search . '%')
                        ->orWhereHas('principalData', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('lastname', 'like', '%' . $search . '%')
                                ->orWhere('id_card', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%')
                                ->orWhere('phone_number', 'like', '%' . $search . '%');
                        });
                });
            })->when($this->career, function ($query) {
                $query->whereHas('careers', function ($q) {
                    $q->where('careers.id', $this->career);
                });
            })->get();
        return view('livewire.convenant-filter', compact('convenants'));
    }
}
