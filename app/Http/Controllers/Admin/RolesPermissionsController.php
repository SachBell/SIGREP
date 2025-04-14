<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsController extends Controller
{
    public function index() {

        $roles = Role::with('permissions')->get();

        return view('admin.user-manager.rolesPermissions', compact('roles'));
    }
}
