<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCalls;
use App\Models\ApplicationDetails;
use App\Models\ReceivinEntity;
use App\Models\UserData;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = ApplicationCalls::where('status_call', 1)->get();

        $user = auth()->user()->userData;

        if (!$user) {
            return redirect()->route('user.dashboard.profile.edit')->with('warning', 'Debes completar el formulario de registro.');
        }

        $userExist = ApplicationDetails::where('id_user_data', $user->id)->exists();

        // dd($user);

        $applicationDetails = auth()->user()->status();

        return view('user.form-register.index', compact('applications', 'userExist', 'applicationDetails'));
    }

    public function create($id)
    {
        $application = ApplicationCalls::findOrFail($id);
        $institutes = ReceivinEntity::all();
        $currentDate = now();

        $user = auth()->user()->userData;

        // Verificar si la postulacion esta activa
        if (!$application->isActive()) {
            return redirect()->back()->with('error', 'El periodo de postulación ha terminado en: ' . $application->end_date);
        }

        if (!$user) {
            return redirect()->route('user.profile.edit')->with('warning', 'Primero debes llenar tus datos personales para postularte');
        }

        // Verificar si el usuario ya está inscrito en alguna convocatoria activa
        $appExist = ApplicationDetails::where('id_user_data', $user->id)
            ->whereHas('applicationCalls', function ($query) use ($currentDate) {
                $query->where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate);
            })
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

        $user = auth()->user()->userData;

        if (!$user) {
            return redirect()->route('user.dashboard.profile.edit')->with('warning', 'Primero debes llenar tus datos personales para postularte');
        }

        $applicationId = $request->input('id_application_calls');
        $applications = ApplicationCalls::findOrFail($applicationId);
        $instituteId = $request->input('id_institute');

        $currentDate = now();
        if ($currentDate->lt($applications->start_date) || $currentDate->gt($applications->end_date)) {
            return redirect()->back()->with('error', 'El periodo de postulación ha terminado en ' . $applications->end_date);
        }

        // Validación de limite de usuarios
        $institutes = ReceivinEntity::findOrFail($instituteId);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institutes->id)->count();

        if ($currentUserCount >= $institutes->user_limit) {
            // dd($currentUserCount);
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }


        ApplicationDetails::create([
            'id_application_calls' => $applicationId,
            'id_user_data' => $user->id,
            'id_institutes' => $instituteId,
            'status_individual' => ApplicationDetails::STATUS_PENDIENTE,
        ]);

        return redirect()->route('user.dashboard.forms.index')->with('success', 'Te has postulado exitosamente.');
    }
}
