<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCalls;
use App\Models\ApplicationDetails;
use App\Models\Institute;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = ApplicationCalls::where('status_call', 1)->get();

        $user = auth()->user()->user_data_id;

        $userExist = ApplicationDetails::where('id_user_data', $user)->exists();

        $applicationDetails = auth()->user()->status();

        return view('user.form-register.index', compact('applications', 'userExist', 'applicationDetails'));
    }

    public function create($id)
    {
        $application = ApplicationCalls::findOrFail($id);
        $institutes = Institute::all();

        $user = auth()->user()->userData;

        $currentDate = now();
        if ($currentDate->lt($application->start_date) || $currentDate->gt($application->end_date)) {
            return redirect()->back()->with('error', 'El periodo de postulación ha terminado en ' . $application->end_date);
        }

        $appExist = ApplicationDetails::where('id_user_data', $user)
            ->where('id_application_calls', $id)
            ->exists();

        if ($appExist) {
            return redirect()->back()->with('error', 'Ya estas inscrito en este periodo.');
        } else {
            return view('user.form-register.partials.create', compact('application', 'user', 'institutes'));
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id_institute' => 'required|exists:institutes,id',
        ]);

        $user = auth()->user()->user_data_id;

        if (!$user) {
            return redirect()->route('user.dashboard')->with('error', 'No tienes datos personales registrados.');
        }

        $applicationId = $request->input('id_application_calls');
        $applications = ApplicationCalls::findOrFail($applicationId);
        $instituteId = $request->input('id_institute');

        $currentDate = now();
        if ($currentDate->lt($applications->start_date) || $currentDate->gt($applications->end_date)) {
            return redirect()->back()->with('error', 'El periodo de postulación ha terminado en ' . $applications->end_date);
        }

        // Validación de limite de usuarios
        $institutes = Institute::findOrFail($instituteId);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institutes->id)->count();

        if ($currentUserCount >= $institutes->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        ApplicationDetails::create([
            'id_application_calls' => $applicationId,
            'id_user_data' => $user,
            'id_institutes' => $instituteId,
            'status_individual' => ApplicationDetails::STATUS_PENDIENTE,
        ]);

        return redirect()->route('user.form-register.index')->with('success', 'Te has postulado exitosamente.');
    }
}
