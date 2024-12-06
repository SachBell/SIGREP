<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\UserData;
use App\Models\User;
use App\Models\Institucion;
use App\Models\Grade;
use App\Models\Semester;
use App\Exports\FormularioExport;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{

    public function index(Request $request) {
        $search = $request->input('search');

        // Consulta base para registros
        $query = UserData::query();

        // Si hay un término de búsqueda
        if (!empty($search)) {
            // Validar longitud mínima del término de búsqueda
            if (strlen($search) < 3) {
                return redirect()->back()->with('warning', 'Por favor, ingresa al menos 3 caracteres para realizar la búsqueda.');
            }

            // Filtrar registros por datos relacionados de `UserData`
            $query->where(function ($query) use ($search) {
                $query->where('cei', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });

        }

        // Cargar relaciones necesarias y paginar resultados
        $registros = $query->with(['institutes', 'semesters', 'grades'])->paginate(5);

        // dd($registros);
        return view('dashboard.registers.index', compact('registros'));
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
            'semester' => 'required',
            'grade' => 'required',
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

            // Crear y almacenar el formulario

            UserData::create($request->all());

            return redirect('/')->with('success', 'Formulario enviado con éxito.');
    }

    public function destroy($id) {

        $registro = UserData::findOrFail($id);
        $registro->delete();

        return redirect()->route('dashboard.registros.index')->with('success', 'Registro eliminado con éxito.');

    }

    public function edit($id) {
        $registro = UserData::findOrFail($id);
        $entidades = Institucion::all();
        $semesters = Semester::all();
        $grades = Grade::all();
        return view('dashboard.registers.partials.edit', compact('registro', 'entidades', 'grades', 'semesters'));
    }

    public function update(Request $request, $id) {
        
        $registro = UserData::findOrFail($id);

        // dd($request->all());

        $request->validate([
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'neighborhood' => 'required',
            'id_semester' => 'required',
            'id_grade' => 'required',
            'daytrip' => 'required',
            'id_institute' => 'required',
        ]);

        $registro->update($request->all());

        return redirect()->route('dashboard.registros.index')->with('success', 'Registro Actualizado con Exito');
    }

    public function export(){
        return Excel::download(new FormularioExport, 'registros.xlsx');
    }
}