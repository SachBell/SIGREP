<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function create()
    {
        $roles = Role::all();
        return view('admin.user-manager.partials.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255|alpha_dash',
            'password' => 'required|string|min:8',
            'email' => 'required|email',
            'id_role' => 'required|exists:roles,id'
        ]);

        // dd($request->all());

        $userEmail = User::where('name', $request->name)
            ->orWhere('email', $request->email)
            ->first();

        if ($userEmail) {
            return redirect()->back()->with('error', 'Ya hay un usuario con estos datos.');
        }

        $newUser = $request->only(['name', 'email', 'id_role']);

        $newUser['password'] = Hash::make($validate['password']);

        User::create($newUser);

        return redirect()->route('admin.user-manager.index')->with('success', 'Usuario creado con éxito.');
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
        $roles = Role::all();

        return view('admin.user-manager.partials.edit', compact('registro', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $registro = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'id_role' => 'required',
        ]);

        $existente = User::where(function ($query) use ($request) {
            $query->where('name', $request->name)
                ->orWhere('email', $request->email);
        })
            ->where('id', '!=', $id)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Este usuario ya está registrado.');
        }

        $registro->update($request->all());

        return redirect()->route('admin.user-manager.index')->with('success', 'Usuario actualizado con éxito.');
    }
}
