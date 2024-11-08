<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Institucion;

class FormController extends Controller
{
    public function create()
    {
        $entidades = Institucion::all();
        return view('welcome', compact('entidades'));
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
            'semester' => 'required',
            'grade' => 'required',
            'daytrip' => 'required',
            'id_institucion' => 'required',
        ]);

        $existente = Formulario::where('cei', $request->cei)
            ->where('email', $request->email)
            ->first();

            if($existente) {
                return redirect()->back()->with('error', 'Ya has registrado este formulario.');
            }

            // Crear y almacenar el formulario

            Formulario::create($request->all());

            return redirect('/')->with('success', 'Formulario enviado con éxito.');
    }
}