<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCalls;
use App\Models\ApplicationDetails;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\ReceivingEntity;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{

    public function index()
    {
        $applications = ApplicationCalls::where('status_call', 1)->get();

        $user = auth()->user()->userData;

        if (!$user) {
            return redirect()->route('user.dashboard.profile.edit')->with('warning', 'Primero debes llenar tus datos personales para postularte.');
        }

        $userExist = ApplicationDetails::where('id_user_data', $user->id)->exists();

        return view('user.index', compact('applications', 'userExist'));
    }

    public function create()
    {
        $entidades = ReceivingEntity::all();
        $grades = Grade::all();
        $semesters = Semester::all();

        return view('welcome', compact('entidades', 'grades', 'semesters'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_card' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'id_semester' => 'required',
            'id_grade' => 'required',
            'daytrip' => 'required',
        ]);

        // dd($request);
        $existente = UserData::where('id_card', $request->id_card)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Ya te hay un usuario registrado con estos datos.');
        }

        $user = auth()->user();

        // Crear y almacenar el formulario
        $user->userData()->create($request->all());

        return Redirect::route('user.dashboard.profile.edit')->with('status', 'data-create');
    }
}
