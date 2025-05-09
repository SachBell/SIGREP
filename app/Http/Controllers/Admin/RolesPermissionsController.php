<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.user-manager.rolesPermissions', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user-manager.partials.rpcreate', compact('permissions'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $roleExist = Role::where('name', $validated['role_name']);

        if ($roleExist) {
            return redirect()->back()->with('error', 'Ese role ya existe, ingresa otro nombre');
        }

        $role = Role::create([
            'name' => $validated['role_name']
        ]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('admin.dashboard.rolespermissions.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.user-manager.partials.rpedit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = \App\Models\Role::findOrFail($id);

        $validated = $request->validate([
            'role_name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $roleExist = Role::where('name', $validated['role_name'])
            ->where('id', '!=', $role->id)
            ->exists();

        if ($roleExist) {
            return redirect()->back()->with('error', 'Ese role ya existe, ingresa otro nombre');
        }

        $role->update([
            'name' => $validated['role_name'],
            'guard_name' => 'web'
        ]);

        if (!empty($validated['role_name'])) {
            $role->syncPermissions($validated['permissions']);
        }

        // dd($role->wasChanged());

        return redirect()->route('admin.dashboard.rolespermissions.index')->with('success', 'Rol editado correctamente.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.dashboard.rolespermissions.index')->with('success', 'Role eliminado con éxito.');
    }
}
