<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;

class InstitutesController extends Controller
{
    public function index(Request $request) {

        $search = $request->input('search');

        // Consulta base para registros
        $query = Institucion::query();

        if (!empty($search)) {
            // Validar longitud mínima del término de búsqueda
            if (strlen($search) < 3) {
                return redirect()->back()->with('warning', 'Por favor, ingresa al menos 3 caracteres para realizar la búsqueda.');
            }

            // Filtrar registros por datos relacionados de `UserData`
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });

        }

        $registros = $query->paginate(5);

        return view('dashboard.institutes.index', compact('registros'));
    }

    public function create(){
        return view('dashboard.institutes.partials.create');
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user_limit' => 'required',
        ]);

        $existente = Institucion::where('name', $request->name)
            ->where('name', $request->name)
            ->first();
            
            if($existente){
                return redirect()->back()->with('error', 'Ya existe una Institución con ese nombre');
            }
        
        Institucion::create($request->all());
        
        return redirect('/institutes')->with('success', 'Institución creada con éxito.');
    }

    public function destroy($id) {
        $registro = Institucion::findOrFail($id);
        $registro->delete();

        return redirect()->route('dashboard.institutes.index')->with('success', 'Institución eliminada con éxito.');
    }

    public function edit($id){
        $registro = Institucion::findOrFail($id);
        
        return view('dashboard.institutes.partials.edit', compact('registro'));
    }

    public function update(Request $request, $id){
        $registro = Institucion::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user_limit' => 'required',
        ]);

        $registro->update($request->all());

        return redirect()->route('dashboard.institutes.index')->with('success', 'Institución actualizada con éxito');
    }
}
