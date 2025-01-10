<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use App\Models\UserData;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function dashboard(){
        return view('user.index');
    }

    public function create() {
        $entidades = Institucion::all();
        $grades = Grade::all();
        $semesters = Semester::all();

        return view('welcome', compact('entidades', 'grades', 'semesters'));
    }

    public function store(Request $request) {

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
            'daytrip' => 'required',
            'id_institute' => 'required',
        ]);

        // dd($request);
        $existente = UserData::where('cei', $request->cei)
            ->where('email', $request->email)
            ->first();


        // dd($existente);
        if($existente) {
            return redirect()->back()->with('error', 'Ya te has registrado en este formulario.');
        }

        // Validación de limite de usuarios
        $institucion = Institucion::findOrFail($request->id_institute);

        $currentUserCount = UserData::where('id_institute', $institucion->id)->count();

        if ($currentUserCount >= $institucion->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        // Crear y almacenar el formulario
        UserData::create($request->all());

        return redirect('/')->with('success', 'Te has registrado con éxito');
    }
}
