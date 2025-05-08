<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\InstitutesImport;
use Illuminate\Http\Request;
use App\Models\ReceivinEntity;
use Maatwebsite\Excel\Facades\Excel;

class InstitutesController extends Controller
{
    public function index(Request $request)
    {
        $registros = ReceivinEntity::orderBy('name', 'asc')->paginate(8);

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

        $existente = ReceivinEntity::where('name', $request->name)
            ->where('name', $request->name)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Ya existe una Institución con ese nombre');
        }

        Institute::create($request->all());

        return redirect()->route('admin.dashboard.institutes.index')->with('success', 'Institución creada con éxito.');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $registros = Institute::search($search)->paginate(5);

        return view('admin.institutes.index', compact('registros'));
    }

    public function destroy($id)
    {
        $registro = ReceivinEntity::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.dashboard.institutes.index')->with('success', 'Institución eliminada con éxito.');
    }

    public function edit($id)
    {
        $registro = ReceivinEntity::findOrFail($id);

        return view('admin.institutes.partials.edit', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        $registro = ReceivinEntity::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user_limit' => 'required|integer|min:1',
        ]);

        $existente = ReceivinEntity::where(function ($query) use ($request) {
            $query->where('name', $request->name);
        })
            ->where('id', '!=', $id)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Este institución ya está registrada.');
        }

        $registro->update($request->all());

        return redirect()->route('admin.dashboard.institutes.index')->with('success', 'Institución actualizada con éxito');
    }

    public function massiveInstitutesImport(Request $request)
    {
        $errors = []; // Array para acumular los errores


        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // dd($request);

        try {
            Excel::import(new InstitutesImport, $request->file('file'));
        } catch (\Exception $e) {
            // Si hay algún error, lo agregamos al array
            $errors[] = $e->getMessage();
        }

        // dd($errors);

        if (count($errors) > 0) {

            // dd($errors);

            return redirect()->route('admin.dashboard.institutes.index')->with('error', 'Hubo algunos errores con la inserción, puede que haya valores repetidos.');
        } else {
            return redirect()->route('admin.dashboard.institutes.index')->with('success', 'Usuarios cargados con éxito.');
        }
    }
}
