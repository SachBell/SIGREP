<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;

class InstitutesController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        // Consulta base para registros
        $query = Institute::query();

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

        return view('admin.institutes.index', compact('registros'));
    }

    public function create()
    {
        return view('admin.institutes.partials.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user_limit' => 'required',
        ]);

        $existente = Institute::where('name', $request->name)
            ->where('name', $request->name)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Ya existe una Institución con ese nombre');
        }

        Institute::create($request->all());

        return redirect()->route('admin.institutes.index')->with('success', 'Institución creada con éxito.');
    }

    public function destroy($id)
    {
        $registro = Institute::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.institutes.index')->with('success', 'Institución eliminada con éxito.');
    }

    public function edit($id)
    {
        $registro = Institute::findOrFail($id);

        return view('admin.institutes.partials.edit', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        $registro = Institute::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user_limit' => 'required|integer|min:1',
        ]);

        $existente = Institute::where(function ($query) use ($request) {
            $query->where('name', $request->name);
        })
            ->where('id', '!=', $id)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Este institución ya está registrada.');
        }

        $registro->update($request->all());

        return redirect()->route('admin.institutes.index')->with('success', 'Institución actualizada con éxito');
    }
}
