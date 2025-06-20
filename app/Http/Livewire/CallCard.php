<?php

namespace App\Http\Livewire;

use App\Models\ApplicationCall;
use App\Models\ApplicationDetail;
use App\Models\Career;
use Livewire\Component;

class CallCard extends Component
{
    public $appCalls;
    public $careers;
    public $registrationCounts = []; // Propiedad pública para los conteos

    public function render()
    {
        $user = auth()->user();

        $this->appCalls = ApplicationCall::byUserCareer($user)->get();
        $this->careers = Career::all();

        // Limpiar conteos anteriores
        $this->registrationCounts = [];

        foreach ($this->appCalls as $call) {
            $query = ApplicationDetail::where('application_calls_id', $call->id);

            if ($user->hasRole('gestor-teacher')) {
                $careerId = optional($user->teacherProfile)->career_id;

                if ($careerId) {
                    $query->whereHas('userData', function ($q) use ($careerId) {
                        $q->where('career_id', $careerId);
                    });
                }
            }

            $this->registrationCounts[$call->id] = $query->count();
        }

        return view('livewire.call-card', [
            'appCalls' => $this->appCalls,
            'careers' => $this->careers,
            'registrationCounts' => $this->registrationCounts // Pasamos los conteos a la vista
        ]);
    }
}
