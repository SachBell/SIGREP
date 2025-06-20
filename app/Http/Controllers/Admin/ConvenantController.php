<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReceivingEntity;
use Illuminate\Http\Request;

class ConvenantController extends Controller
{
    public function index()
    {
        return view('Admin.convenants.index');
    }

    public function destroy($id)
    {
        $call = ReceivingEntity::findOrFail($id);

        $this->authorize('delete', $call);

        $call->delete();

        return redirect()->back()->with('success', 'Convocatoria eliminada con éxito.');
    }
}
