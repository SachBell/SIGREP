<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDetail;
use Illuminate\Http\Request;

class StudentPostController extends Controller
{
    public function index()
    {
        return view('Admin.student-posts.index');
    }

    public function destroy($id)
    {
        $call = ApplicationDetail::findOrFail($id);

        // $this->authorize('delete', $call);

        $call->delete();

        return redirect()->back()->with('success', 'Convocatoria eliminada con éxito.');
    }
}
