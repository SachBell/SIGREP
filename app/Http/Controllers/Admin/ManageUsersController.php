<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);

        return view('admin.manage-users.index');
    }

    public function destroy($id)
    {
        $call = User::findOrFail($id);

        $this->authorize('delete', $call);

        $call->delete();

        session()->flash('notification', [
            'type' => 'error',
            'message' => 'Usuario eliminado correctamente'
        ]);

        return redirect()->back()->with('success', 'Convocatoria eliminada con éxito.');
    }
}
