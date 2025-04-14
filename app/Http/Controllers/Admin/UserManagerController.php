<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserManagerController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $registros = User::select('users.*')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->orderBy('roles.name', 'asc')
            ->paginate(8);
        // dd($registros);
        return view('admin.user-manager.index', compact('registros', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user-manager.partials.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|alpha_dash|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email',
            'id_role' => 'required'
        ]);


        $userEmail = User::where('name', $request->name)
            ->orWhere('email', $request->email)
            ->first();

        if ($userEmail) {
            return redirect()->back()->with('error', 'Ya hay un usuario con estos datos.');
        }

        $newUser = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        $role = Role::where('name', $validate['id_role'])->first();
        $newUser->assignRole($role);

        // dd($newUser);

        return redirect()->route('admin.dashboard.user-manager.index')->with('success', 'Usuario creado con éxito.');
    }

    public function destroy($id)
    {
        $registro = User::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.dashboard.user-manager.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function show() {}

    public function edit($id)
    {
        $registro = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user-manager.partials.edit', compact('registro', 'roles'));
    }

    public function search(Request $request)
    {
        $roles = Role::all();

        $search = $request->input('query');

        $registros = User::search($search)->paginate(6);

        return view('admin.user-manager.index', compact('registros', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $registro = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|alpha_dash|max:255',
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

        $role = Role::where('name', $request['id_role'])->first();
        $registro->syncRoles([$role->name]);

        return redirect()->route('admin.dashboard.user-manager.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function sendResetPassword(Request $request, $id)
    {
        $registro = User::findOrFail($id);

        // dd($registro);

        Password::sendResetLink(['email' => $registro->email]);

        return redirect()->back()->with('success', 'Se ha enviado un correo de reseteo de contraseña al usuario.');
    }

    public function massiveUsersImport(Request $request)
    {

        $errors = []; // Array para acumular los errores


        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // dd($request);

        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (\Exception $e) {
            // Si hay algún error, lo agregamos al array
            $errors[] = $e->getMessage();
        }

        // dd($errors);

        if (count($errors) > 0) {
            return redirect()->route('admin.dashboard.user-manager.index')->with('error', 'Hubo algunos errores con la inserción, puede que haya valores repetidos.');
        } else {
            return redirect()->route('admin.dashboard.user-manager.index')->with('success', 'Usuarios cargados con éxito.');
        }
    }
}
