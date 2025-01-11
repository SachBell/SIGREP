<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consulta base para registros
        $query = User::query();

        // Si hay un término de búsqueda
        if (!empty($search)) {
            // Validar longitud mínima del término de búsqueda
            if (strlen($search) < 3) {
                return redirect()->back()->with('warning', 'Por favor, ingresa al menos 3 caracteres para realizar la búsqueda.');
            }

            // Filtrar registros por datos relacionados de `UserData`
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('userRole', 'like', '%' . $search . '%');
            });
        }

        // Cargar relaciones necesarias y paginar resultados
        $registros = $query->paginate(5);

        // dd($registros);
        return view('admin.user-manager.index', compact('registros'));
    }

    public function destroy($id)
    {
        $registro = User::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.user-manager.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function edit($id)
    {
        $registro = User::findOrFail($id);

        return view('admin.user-manager.partials.edit', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        $registro = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $registro->update($request->all());

        return redirect()->route('admin.user-manager.index')->with('success', 'Usuario actualizado con éxito.');
    }
}
