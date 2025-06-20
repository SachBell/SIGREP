<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Career $career)
    {
        $this->authorize('viewAny', $career);

        return view('Admin.careers.index');
    }

    public function destroy($id)
    {
        $career = Career::findOrFail($id);

        $this->authorize('delete', $career);

        $career->delete();

        return redirect()->back()->with('success', 'Convocatoria eliminada con éxito.');
    }
}
