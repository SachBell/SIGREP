<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCall;
use App\Models\ApplicationDetail;
use App\Models\ReceivingEntity;
use Illuminate\Http\Request;

class ApplicationCallsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userData = $user->profile->userData;
        $careerId = $userData?->career_id;

        $calls = ApplicationCall::byUserCareer($user)
            ->with('career')
            ->get();

        $institutes = ReceivingEntity::byEntityCareer($user)->get();

        $userExist = ApplicationDetail::where('user_data_id', $userData?->id)->exists();

        $count = ApplicationDetail::whereHas('userData', function ($q) use ($careerId) {
            $q->where('career_id', $careerId);
        })->count();

        if ($userExist) {
            return redirect()->route('progres.index');
        }

        return view('dashboard.app-calls.index', compact('calls', 'institutes', 'userExist'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'id_institute' => 'required|exists:receiving_entities,id'
        ]);

        // dd($request->all());

        $user = auth()->user()->profile->userData;

        $applicationId = $request->input('id_application_calls');
        // $applications = ApplicationCall::findOrFail($applicationId);
        $instituteId = $request->input('id_institute');

        // $currentDate = now();
        // if ($currentDate->lt($applications->start_date) || $currentDate->gt($applications->end_date)) {
        //     return redirect()->back()->with('error', 'El periodo de postulación ha terminado en ' . $applications->end_date);
        // }

        // Validación de limite de usuarios
        $institutes = ReceivingEntity::findOrFail($instituteId);

        $currentUserCount = ApplicationDetail::where('receiving_entity_id', $institutes->id)->count();

        if ($currentUserCount >= $institutes->user_limit) {
            // dd($currentUserCount);
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        // dd($user->id);

        ApplicationDetail::create([
            'application_calls_id' => $applicationId,
            'user_data_id' => $user->id,
            'receiving_entity_id' => $instituteId,
        ]);

        return redirect()->back()->with('success', 'Te has postulado exitosamente.');
    }
}
