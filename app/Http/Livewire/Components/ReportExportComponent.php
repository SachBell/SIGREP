<?php

namespace App\Http\Livewire\Components;

use App\Models\ApplicationCall;
use App\Models\Career;
use Livewire\Component;

class ReportExportComponent extends Component
{

    public $careers = [];
    public $calls = [];
    public $tutors = [];
    public $students = [];

    public $report_type = '';
    public $career_id = '';
    public $call_id = '';

    public function mount()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {

            $this->careers = Career::all();
            $this->calls = ApplicationCall::orderByDesc('start_date')->get();
        } elseif ($user->hasRole('gestor-teacher')) {

            $careerId = $user->getCareerIdForScope();

            $this->career_id = $careerId;
            $this->careers = Career::where('id', $careerId)->get();

            $this->calls = ApplicationCall::where('career_id', $careerId)->orderByDesc('start_date')->get();
        }
    }

    public function updatedCareerId($value)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $this->calls = $value
                ? ApplicationCall::where('career_id', $value)->orderByDesc('start_date')->get()
                : ApplicationCall::orderByDesc('start_date')->get();
        } else {
            $careerId = $user->getCareerIdForScope();

            if ($value == $careerId) {
                $this->calls = ApplicationCall::where('career_id', $careerId)
                    ->orderByDesc('start_date')->get();
            } else {
                $this->calls = collect();
            }
        }

        $this->call_id = '';

        if ($this->report_type === 'teacher') {
            $this->loadTutors($value);
        } elseif ($this->report_type === 'student') {
            $this->loadStudents($value);
        }
    }

    private function loadTutors($careerId)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $this->tutors = \App\Models\TeacherProfile::with('user')
                ->where('career_id', $careerId)
                ->get();
        } else {
            $userCareer = $user->getCareerIdForScope();
            if ($careerId == $userCareer) {
                $this->tutors = \App\Models\TeacherProfile::with('user')
                    ->where('career_id', $userCareer)
                    ->get();
            } else {
                $this->tutors = collect();
            }
        }
    }

    private function loadStudents($careerId)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $this->students = \App\Models\UserProfile::with('userData')
                ->whereHas('userData', function ($q) use ($careerId) {
                    $q->where('career_id', $careerId);
                })->get();
        } else {
            $userCareer = $user->getCareerIdForScope();
            if ($careerId == $userCareer) {
                $this->students = \App\Models\UserProfile::with('userData')
                    ->whereHas('userData', function ($q) use ($userCareer) {
                        $q->where('career_id', $userCareer);
                    })->get();
            } else {
                $this->students = collect();
            }
        }
    }


    public function updatedReportType($value)
    {
        $careerId = $this->career_id ?: auth()->user()->getCareerIdForScope();

        if ($value === 'teacher') {
            $this->loadTutors($careerId);
            $this->students = [];
        } elseif ($value === 'student') {
            $this->loadStudents($careerId);
            $this->tutors = [];
        } else {
            $this->tutors = [];
            $this->students = [];
        }
    }


    public function render()
    {
        return view('livewire.components.report-export-component', [
            'careers' => $this->careers,
            'calls' => $this->calls,
        ]);
    }
}
