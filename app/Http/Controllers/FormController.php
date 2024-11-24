<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Institucion;
use App\Exports\FormularioExport;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{

    public function index(Request $request) {
        
        $search = $request->input('search');

        // Si se realiza una búsqueda y no hay resultados
        if (!empty($search)) {
            $query = Formulario::query();
            $query->where(function ($query) use ($search) {
                $query->where('cei', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            }); 

            // Verificar si no hay resultados
            if ($query->exists()) {
                // Si la búsqueda está vacía o tiene menos de 3 caracteres
                if (!empty($search) && strlen($search) < 3) {
                    return redirect()->back()->with('warning', 'Por favor, ingresa al menos 3 caracteres para realizar la búsqueda.');
                }
            } else {                
                // Redirigir de vuelta sin mensajes
                return redirect()->route('registros.index');
            }

            $registros = $query->with('institucion')->paginate(5);
        } else {
            // Si no hay búsqueda, obtener todos los registros
            $registros = Formulario::with('institucion')->paginate(5);
        }
        
        return view('registers.index', compact('registros'));
    }

    public function create() {
        $entidades = Institucion::all();
        $forms = Formulario::with('institucion')->get();
        return view('welcome', compact('entidades', 'forms'));
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
            'semester' => 'required',
            'grade' => 'required',
            'daytrip' => 'required',
            'id_institucion' => 'required',
        ]);

        $existente = Formulario::where('cei', $request->cei)
            ->where('email', $request->email)
            ->first();

            if($existente) {
                return redirect()->back()->with('error', 'Ya te has registrado en este formulario.');
            }

            // Crear y almacenar el formulario

            Formulario::create($request->all());

            return redirect('/')->with('success', 'Formulario enviado con éxito.');
    }

    public function destroy($id) {

        $registro = Formulario::findOrFail($id);
        $registro->delete();

        return redirect()->route('registros.index')->with('success', 'Registro eliminado con éxito.');

    }

    public function edit($id) {
        $registro = Formulario::findOrFail($id);
        $instituciones = Institucion::all();
        return view('registers.partials.edit', compact('registro', 'instituciones'));
    }

    public function update(Request $request, $id) {
        
        $registro = Formulario::findOrFail($id);

        $request->validate([
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'neighborhood' => 'required',
            'semester' => 'required',
            'grade' => 'required',
            'daytrip' => 'required',
            'id_institucion' => 'required',
        ]);

        $registro->update($request->all());

        return redirect()->route('registros.index')->with('success', 'Registro Actualizado con Exito');
    }

    public function export(){
        return Excel::download(new FormularioExport, 'registros.xlsx');
    }
}