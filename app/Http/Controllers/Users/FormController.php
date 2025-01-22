<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCalls;
use App\Models\ApplicationDetails;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Institute;
use App\Models\UserData;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function dashboard()
    {
        $applications = ApplicationCalls::where('status_call', 1)->get();

        $user = auth()->user()->user_data_id;

        $userExist = ApplicationDetails::where('id_user_data', $user)->exists();

        return view('user.index', compact('applications', 'userExist'));
    }

    public function create()
    {
        $entidades = Institute::all();
        $grades = Grade::all();
        $semesters = Semester::all();

        return view('welcome', compact('entidades', 'grades', 'semesters'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'id_semester' => 'required',
            'id_grade' => 'required',
            'id_institute' => 'required|exists:institutes,id',
            'daytrip' => 'required',
        ]);

        // dd($request);
        $existente = UserData::where('cei', $request->cei)
            ->orWhere('email', $request->email)
            ->first();


        // dd($existente);
        if ($existente) {
            return redirect()->back()->with('error', 'Ya te has registrado en este formulario.');
        }

        // Validación de limite de usuarios
        $institucion = Institute::findOrFail($request->id_institute);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institucion->id)->count();

        if ($currentUserCount >= $institucion->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        // Crear y almacenar el formulario
        $userData = UserData::create($request->all());

        ApplicationDetails::create([
            'id_application_calls' => null, // Define si hay una convocatoria activa
            'id_user_data' => $userData->id,
            'id_institutes' => $institucion->id,
            'status_individual' => 'Pendiente', // O el estado inicial que prefieras
        ]);

        return redirect('/')->with('success', 'Te has registrado con éxito');
    }
}
